<?php

class AdminController extends BaseController 
    {
    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
        {
        parent::__construct();
        }
	
	public function redirectToLogin()
		{
		if (!Auth::check())
			{
			return Redirect::intended('user/login');
			}
		else
			{
			return Redirect::intended('dashboard');
			}
		}
        
	public function statements()
		{
		$title = "Statements Page";
        
        $uid = Auth::user()->id;
        $activityNames = DB::table("statements")->select(array('activity_name'))->where("uid",$uid)->groupBy('activity_name')->get();
		
		return View::make('site/statements', compact('title','activityNames'));
		}
        
	public function statementsData()
        {
        $uid = Auth::user()->id;
        $statements = DB::table("statements")->select(array('timestamp', 'verb_id', 'verb_value', 'verb_description', 'activity_name'))->where("uid",$uid);
        
        if(Input::get("activityName") != "all")
            {
            $statements->where("activity_name",Input::get("activityName"));
            }
        
        return Datatables::of($statements)->make();
        }
    
    public function statistics()
        {
        $title = "Statistics Page";
		
        $daterange = 0;
		$range = "";
		$rangeArr = array();
		if(Input::has('date-range'))
			{
			$daterange = 1;
			$range = Input::get('date-range');
			$get = Input::get('date-range');
			$rangeArr = explode(" - ",$get);
			$rangeArr[0] = str_replace("/","-",$rangeArr[0]);
			$rangeArr[0] = strtotime($rangeArr[0]);
			$rangeArr[1] = str_replace("/","-",$rangeArr[1]);
			$rangeArr[1] = strtotime($rangeArr[1]);
			}
        
        $uid = Auth::user()->id;
		$statements = DB::table("statements")->where("uid",$uid)->orderBy('timestamp', 'desc')->get();

		$counter = 0;
		$matched = 0;
		$popular_activities = array();
		
		foreach($statements as $statement)
			{
			if($range != "")
				{
				if($rangeArr[0] > strtotime($statement->timestamp) && $rangeArr[1] > strtotime($statement->timestamp))
					{
					continue;
					}
				}
				
			$matched = 0;
			
			if($counter == 0)
				{
				$popular_activities[0]['name'] = $statement->activity_name;
				$popular_activities[0]['y'] = 0;
				$popular_activities[0]['y'] = $popular_activities[0]['y']+1;
				
				$counter++;
				continue;
				}
			for($i = 0;$i < $counter;$i++)
				{
				if($popular_activities[$i]['name'] == $statement->activity_name)
					{
					$popular_activities[$i]['y'] = $popular_activities[$i]['y'] + 1;
					$matched = 1;
					}
				}
			if($matched == 1)
				{
				continue;
				}
			$popular_activities[$counter]['name'] = $statement->activity_name;
			$popular_activities[$counter]['y'] = 0;
			$popular_activities[$counter]['y'] = $popular_activities[$counter]['y']+1;
			$counter++;
			}
		$counter = 0;
		usort($popular_activities, function($a, $b) {
			return $b['y'] > $a['y'];
			});
        
        $popular_activities = json_encode($popular_activities);
        
		return View::make('site/stats', compact('title','range','popular_activities'));
        }
    
	public function dashboard()
		{
		$daterange = 0;
		$range = "";
		$rangeArr = array();
		if(Input::has('date-range'))
			{
			$daterange = 1;
			$range = Input::get('date-range');
			$get = Input::get('date-range');
			$rangeArr = explode(" - ",$get);
			$rangeArr[0] = str_replace("/","-",$rangeArr[0]);
			$rangeArr[0] = strtotime($rangeArr[0]);
			$rangeArr[1] = str_replace("/","-",$rangeArr[1]);
			$rangeArr[1] = strtotime($rangeArr[1]);
			}
			
		$title = "Dashboard";
		
		$uid = Auth::user()->id;
		$statements = DB::table("statements")->where("uid",$uid)->orderBy('timestamp', 'desc')->get();

		$date_array = array();
		$date_counts = array();
		$counter = 0;
		$matched = 0;
		$user_count = array();
		$popular_activities = array();
		
		foreach($statements as $statement)
			{
			if($range != "")
				{
				if($rangeArr[0] > strtotime($statement->timestamp) && $rangeArr[1] > strtotime($statement->timestamp))
					{
					continue;
					}
				}
				
			$matched = 0;
			
			if($counter == 0)
				{
				$popular_activities[0]['email'] = $statement->activity_name;
				$popular_activities[0]['count'] = 0;
				$popular_activities[0]['count'] = $popular_activities[0]['count']+1;
				
				$counter++;
				continue;
				}
			for($i = 0;$i < $counter;$i++)
				{
				if($popular_activities[$i]['email'] == $statement->activity_name)
					{
					$popular_activities[$i]['count'] = $popular_activities[$i]['count'] + 1;
					$matched = 1;
					}
				}
			if($matched == 1)
				{
				continue;
				}
			$popular_activities[$counter]['email'] = $statement->activity_name;
			$popular_activities[$counter]['count'] = 0;
			$popular_activities[$counter]['count'] = $popular_activities[$counter]['count']+1;
			$counter++;
			}
		$counter = 0;
		usort($popular_activities, function($a, $b) {
			return $b['count'] > $a['count'];
			});
			
		$counter = 0;
		foreach($statements as $statement)
			{
			if($range != "")
				{
				if($rangeArr[0] > strtotime($statement->timestamp) && $rangeArr[1] > strtotime($statement->timestamp))
					{
					//echo "hello"; exit;
					continue;
					}
				}
				
			$matched = 0;
			
			if($counter == 0)
				{
				$date_array[0] = date("d-M-Y",strtotime($statement->timestamp));
				$date_counts[0] = 0;
				$date_counts[0] = $date_counts[0] + 1;
				$counter++;
				continue;
				}
			for($i = 0;$i < $counter;$i++)
				{
				if($date_array[$i] == date("d-M-Y",strtotime($statement->timestamp)))
					{
					$date_counts[$i] = $date_counts[$i] + 1;
					$matched = 1;
					}
				}
			if($matched == 1)
				{
				continue;
				}
			$date_array[$counter] = date("d-M-Y",strtotime($statement->timestamp));
			$date_counts[$counter] = 0;
			$date_counts[$counter] = $date_counts[$counter] + 1;
			$counter++;
			}
		
		$date_array = json_encode($date_array);
		$date_counts = json_encode($date_counts);
		$sid = Auth::user()->sid;
		$auth = Auth::user()->auth;
		return View::make('site/dashboard', compact('title','date_array','date_counts','user_count','popular_activities', 'range','sid','auth'));
		}
	}