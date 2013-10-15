<?php  
    //First of all we'll just display a single activity, then later we can make it so you can browse them
      
    //Class which contains all the information for a particular activity
    class ActivityDetails {
        
        //Activity Fields
        public $activityName;
        public $exampleInput;
        public $exampleOutput;
        public $description;
        public $studentCode;
        
        //Database Connection
        private $con;
        
        public function __construct($activityID) {
            $this->con = mysqli_connect("localhost", "root"); //Create DB connection
            mysqli_select_db($this->con, "automatedtestsuite");
            
            //Get each of the fields    
            
            //Activity Name
            $query = mysqli_query($this->con, "SELECT ActivityName FROM activities WHERE ActivityID='$activityID'");
            $results = mysqli_fetch_array($query);
            $this->activityName = $results[0];
            
            //Example Input
            $query = mysqli_query($this->con, "SELECT ExampleInput FROM activities WHERE ActivityID='$activityID'");
            $results = mysqli_fetch_array($query);
            $this->exampleInput = $results[0];
            
            //Example output
            $query = mysqli_query($this->con, "SELECT ExampleOutput FROM activities WHERE ActivityID='$activityID'");
            $results = mysqli_fetch_array($query);
            $this->exampleOutput = $results[0];
            
            //Description
            $query = mysqli_query($this->con, "SELECT Description FROM activities WHERE ActivityID='$activityID'");
            $results = mysqli_fetch_array($query);
            $this->description = $results[0];
             
            //Student Code
            $query = mysqli_query($this->con, "SELECT StudentCode FROM activities WHERE ActivityID='$activityID'");
            $results = mysqli_fetch_array($query);
            $this->studentCode = $results[0];
                        
        }


    }
?>