<?php
header('Access-Control-Allow-Origin: *'); 

class ApiController extends BaseController 
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
	
	public function verifySidAuth()
		{
		$get = DB::table('users')->where('sid', Input::get('SID'))->where('auth', Input::get('auth'))->first();
		
		if(count($get) == 0)
			{
			return "false";
			}
		else
			{
			return "true";
			}
		}
		
    public function sidAuth($username, $password)
		{
		$get = DB::table('users')->where('sid', $username)->where('auth', $password)->first();
		
		if(count($get) == 0)
			{
			return -1;
			}
		else
			{
			return $get;
			}
		}
	
    public function createStatement()
        {
		$result = 1;
		if(Input::has('SID') && Input::has('auth'))
			{
			$result = $this->sidAuth(Input::get('SID'), Input::get('auth'));
			}
		else if($result == -1)
			{
			echo "Wrong SID or Auth";
			return;
			}
		else
			{
			echo "SID and Auth not provided";
			return;
			}
			
		if(!Input::has('activityName') || Input::get('activityName') == "")
			{
			echo "Please provide activityName";
			return;
			}
		
		DB::table('statements')->insert(
			array(
				'timestamp' => date("Y-m-d H:i:s"), 
				'actor_mbox' => $result->email,
				'actor_name' => $result->username,
				'verb_id' => Input::get('verb_id'),
				'verb_language' => Input::get('verb_name'),
				'verb_value' => Input::get('verb_value'),
				'verb_description' => Input::get('verb_desc'),
				'object_id' => Input::get('object_id'),
				'object_name' => Input::get('object_name'),
				'object_description' => Input::get('object_description'),
				'activity_name' => Input::get('activityName'),
				'uid' => $result->id,
				)
			);
		echo "Statement Created";
		}

	public function getStatements()
		{
		$result = 1;
		if(Input::has('SID') && Input::has('auth'))
			{
			$result = $this->sidAuth(Input::get('SID'), Input::get('auth'));
			}
		else if($result == -1)
			{
			echo "Wrong SID or Auth";
			return;
			}
		else
			{
			echo "SID and Auth not provided";
			return;
			}
			
		$order = "";
		$limit = "";
		$where = " where";
		
		if(Input::has('orderbyClause'))
			{
			if(Input::get('orderbyClause') != "")
				{
				if(strtolower(Input::get('orderbyClause')) == "dateregistered")
					{
					$order = " order by timestamp";
					}
				else if(strtolower(Input::get('orderbyClause')) == "name")
					{
					$order = " order by activity_name";
					}
				else
					{
					echo "Wrong 'orderbyClause' provided";
					return;
					}
				}
			}
		if(Input::has('OrderPatern'))
			{
			if(Input::get('OrderPatern') != "")
				{
				if(strtolower(Input::get('OrderPatern')) != "asc" && strtolower(Input::get('OrderPatern')) != "desc")
					{
					echo "Wrong 'OrderPatern' provided";
					return;
					}
				if($order == "")
					{
					$order .= " order by activity_name " . Input::get('OrderPatern');
					}
				else
					{
					$order .= " " . Input::get('OrderPatern');
					}
				}
			}
		if(Input::has('fromRowNumber'))
			{
			if(Input::get('fromRowNumber') != "")
				{
				$limit = " LIMIT " . Input::get('fromRowNumber');
				}
			}
		if(Input::has('toRowNumber'))
			{
			if(Input::get('toRowNumber') != "")
				{
				if($limit == "")
					{
					$limit = " LIMIT " . Input::get('toRowNumber');
					}
				else
					{
					$limit .= ", " . Input::get('toRowNumber');
					}
				}
			}
		if(Input::has('LikeClause'))
			{
			if(Input::get('LikeClause') != "")
				{
				$where .= " (activity_name like '%" . Input::get('LikeClause') . "%' or 
							verb_id like '%" . Input::get('LikeClause') . "%' or 
							verb_desc like '%" . Input::get('LikeClause') . "%' or 
							object_id like '%" . Input::get('LikeClause') . "%' or 
							object_description like '%" . Input::get('LikeClause') . "%')";
				}
			}
		if(Input::has('ActivityName'))
			{
			if(Input::get('ActivityName') != "")
				{
				if($where != " where")
					{
					$where .= " and"; 
					}
				$where .= " activity_name='" . Input::get('ActivityName') . "'";
				}
			}
			
		//echo "SELECT * FROM statements $where $order $limit ";
		if($where == " where")
			{
			$where = " where uid='".$result->id."'";
			}
		else 
			{
			$where .= " and uid='".$result->id."'"; 
			}
		
		echo "SELECT * FROM statements $where $order $limit"; exit;
		$results = DB::select( DB::raw("SELECT * FROM statements $where $order $limit") );
		
		echo json_encode($results);
		}
	public function createLearner()
		{
		$result = 1;
		if(Input::has('username') && Input::has('password'))
			{
			$result = $this->sidAuth(Input::has('username'), Input::has('password'));
			}
		else if($result != 1)
			{
			echo "Wrong Username or Password";
			return;
			}
		else
			{
			echo "Username and Password not provided";
			return;
			}
			
		if(!Input::has('email'))
			{
			echo "Learner email is not provided";
			return;
			}
		else if(!Input::has('FullName'))
			{
			echo "Learner fullname is not provided";
			return;
			}
		else if(!Input::has('sid'))
			{
			echo "Learner SID is not provided";
			return;
			}
		else
			{
			$userepo = new UserRepository;
			$user = $userepo->signup(Input::all());
			
			if ($user->id)
				{
				echo $user->id;
				}
			else 
				{
				$get = $user->errors()->all(':message');
				$error['error'] = 'error';
				$error['message'] = $get[0];
				echo json_encode($error);
				}
			}
		}

	public function getLearners()
		{
		$result = 1;
		if(Input::has('username') && Input::has('password'))
			{
			$result = $this->sidAuth(Input::has('username'), Input::has('password'));
			}
		else if($result != 1)
			{
			echo "Wrong Username or Password";
			return;
			}
		else
			{
			echo "Username and Password not provided";
			return;
			}
			
		$order = "";
		$limit = "";
		$where = " where";
		
		if(Input::has('orderbyClause'))
			{
			if(Input::get('orderbyClause') != "")
				{
				if(strtolower(Input::get('orderbyClause')) == "email")
					{
					$order = " order by email";
					}
				else if(strtolower(Input::get('orderbyClause')) == "dateregistered")
					{
					$order = " order by created_at";
					}
				else if(strtolower(Input::get('orderbyClause')) == "name")
					{
					$order = " order by username";
					}
				else
					{
					echo "Wrong 'orderbyClause' provided";
					return;
					}
				}
			}
		if(Input::has('OrderPatern'))
			{
			if(Input::get('OrderPatern') != "")
				{
				if(strtolower(Input::get('OrderPatern')) != "asc" && strtolower(Input::get('OrderPatern')) != "desc")
					{
					echo "Wrong 'OrderPatern' provided";
					return;
					}
				if($order == "")
					{
					$order .= " order by created_at " . Input::get('OrderPatern');
					}
				else
					{
					$order .= " " . Input::get('OrderPatern');
					}
				}
			}
		if(Input::has('fromRowNumber'))
			{
			if(Input::get('fromRowNumber') != "")
				{
				$limit = " LIMIT " . Input::get('fromRowNumber');
				}
			}
		if(Input::has('toRowNumber'))
			{
			if(Input::get('toRowNumber') != "")
				{
				if($limit == "")
					{
					$limit = " LIMIT " . Input::get('toRowNumber');
					}
				else
					{
					$limit .= ", " . Input::get('toRowNumber');
					}
				}
			}
		if(Input::has('LikeClause'))
			{
			if(Input::get('LikeClause') != "")
				{
				$where .= " (username like '%" . Input::get('LikeClause') . "%')";
				}
			}
			
		//echo "SELECT * FROM statements $where $order $limit ";
		if($where == " where")
			{
			$where = ""; 
			}
		
		$results['LearnerData'] = DB::select( DB::raw("SELECT id, username as name, email, sid FROM users $where $order $limit") );
		
		echo json_encode($results);
		}
		
	public function createLMS()
		{
		$result = 1;
		if(Input::has('username') && Input::has('password'))
			{
			$result = $this->sidAuth(Input::has('username'), Input::has('password'));
			}
		else if($result != 1)
			{
			echo "Wrong Username or Password";
			return;
			}
		else
			{
			echo "Username and Password not provided";
			return;
			}
			
		$desc = "";	
		
		if(!Input::has('Title'))
			{
			echo "LMS title is not provided";
			return;
			}
		if(Input::has('Description'))
			{
			$desc = Input::get('Description');	
			}
		if(!Input::has('SID'))
			{
			echo "SID is not provided";
			return;
			}
		else
			{
			$get = DB::table('users')->where('sid',Input::get('SID'))->first();
			if(count($get) == 0)
				{
				echo "learner with that SID is not found";
				return;
				}
			}
			
		DB::table('lms')->insert(
			array('lms_title' => Input::get('Title'), 'lms_description' => Input::get('Description'), 'created_date' => date("Y-m-d H:i:s"), 'sid' => Input::get('SID') )
			);
		
		echo "success";
		}
		
	public function getAllLMS()
		{
		$result = 1;
		if(Input::has('username') && Input::has('password'))
			{
			$result = $this->sidAuth(Input::has('username'), Input::has('password'));
			}
		else if($result != 1)
			{
			echo "Wrong Username or Password";
			return;
			}
		else
			{
			echo "Username and Password not provided";
			return;
			}
		
		if(!Input::has('SID'))
			{
			echo "SID is not provided";
			return;
			}
		if(Input::get('SID') == "")
			{
			echo "SID should not be null";
			return;
			}
		$get = DB::table('users')->where('sid',Input::get('SID'))->first();
		if(count($get) == 0)
			{
			echo "learner with that SID is not found";
			return;
			}
		$get = DB::table('lms')->select('id','lms_title as title')->where('sid',Input::get('SID'))->get();
		
		echo json_encode($get);
		}
	public function statements()
		{
		
		}
    }
?>