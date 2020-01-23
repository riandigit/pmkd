<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   Library log activity to txt.
*   @author Arief Darmawan <arief.darmawan1991@gmail.com>
*/
class Log_activity_txt
{
    protected $file_path;
    protected $file_name;
    protected $file_line;

    /**
    *   Check directory's and file's existence, create it, open it, and return the file object.
    *
    *   @param  void
    *
    *   @return object  Opened file as spl file object.
    */
    public function openFile()
    {
        // check directory $file_path and create the directory if it doesn't exist
        if (!file_exists($this->file_path)) {
            if (!mkdir($this->file_path, 0777, true)) {
               throw new Exception('Failed to create directory.');
            }
        }

        // open $file_name and create the file if it doesn't exist
        $file = new SplFileObject($this->file_path.$this->file_name, 'a+');

        return $file;
    }

    /**
    *   Close the file object.
    *
    *   @param  object  $file_object    Spl file object.
    *
    *   @return void
    */
    public function closeFile($file_object)
    {
        $file_object = null;
    }

    /**
    *   Start logging current activity.
    *
    *   @param  array   $log_data   Data to be logged. Recommended structure: ['action', 'username', 'new_data', 'old_data']
    *   @param  array   $log_path   [Optional] Additional path and file name for the log. Recommended structure: ['table_name']
    *
    *   @return void
    */
    public function startLog($log_data, $log_path = null)
    {
        // specify file path and name
        $additional_path = null;
        $additional_name = null;

        if ($log_path !== null && is_array($log_path)) {
            $additional_path = implode('/', $log_path).'/';
            $additional_name = implode('_', $log_path).'_';
        }

        $this->file_path = './logs/'.$additional_path.date('Y/m/');
        $this->file_name = 'log_'.$additional_name.date('Y_m_d').'.log';
        
        // open the file
        $log_file = $this->openFile();

        // get current (last) line
        $log_file->seek(PHP_INT_MAX);
        $this->file_line = $log_file->key() + 1;
        
        // write the log
        $time_of_day = gettimeofday(); 
        $timestamp = date('Y-m-d H:i:s.',$time_of_day['sec']) . $time_of_day['usec'];

        $log_string = "\n\n".$timestamp.'|'.implode('|', $log_data);
        $log_file->fwrite($log_string);
        
        // close the file
        $this->closeFile($log_file);
    }

    /**
    *   Add log to current activity.
    *
    *   @param  array   $log_data   Data to be logged. Recommended structure: ['action', 'username', 'new_data', 'old_data']
    *
    *   @return void
    */
    public function addLog($log_data)
    {
        // open the file
        $log_file = $this->openFile();

        // get current (last) line
        $log_file->seek($this->file_line);
        $this->file_line = $log_file->key() + 1;
        
        // write the log
        $time_of_day = gettimeofday(); 
        $timestamp = date('Y-m-d H:i:s.',$time_of_day['sec']) . $time_of_day['usec'];
        
        $log_string = "\n".$timestamp.'|'.implode('|', $log_data);
        $log_file->fwrite($log_string);
        
        // close the file
        $this->closeFile($log_file);
    }
}
