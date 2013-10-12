<?php

    //Contains textual representations of Java class
    class TestCaseTemplate {
    
        private $classHeader;
        private $testCasesDefinition;
        
        private $mainDefinition;
        private $testCasesMethodDefinition;
        private $testedMethodDefinition;
        
        private $testMethodString;
        
        public $classString;
        
        public function __construct() {
            $this->testCasesDefinition          = "private static int testCases;";   
            $this->mainDefinition               = "public static void main(String[] args) { testMethod(args); }";
            $this->testCasesMethodDefinition    = "private static void numTestCases(int numTestCases) { testCases = numTestCases; }";
            $this->testedMethodDefinition       = "private static void tested(int testNumber) { System.out.println(testNumber); }";
        }
        
        function nameClass($name) {
            $this->classHeader = "public class $name {";
        }
    
        function setTestMethod($testMethodStringParam) {
            $this->testMethodString = $testMethodStringParam;   
        }
    
        //Construct Class String
        function createClass() {
            $this->classString = $this->classHeader . "\n" .
            $this->testCasesDefinition . "\n" .
            $this->mainDefinition . "\n" .
            $this->testCasesMethodDefinition . "\n" .
            $this->testedMethodDefinition . "\n" .
            $this->testMethodString . "\n" .
            "}";            
        }

    }
?>