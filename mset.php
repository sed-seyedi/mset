<?php
function mset_parse($str,$key_filter_func = null){
    if(!is_callable($key_filter_func)){
        $key_filter_func = function ($k) {
            $k = strtolower($k);
            $k = trim($k);
            #### replace multiple occurrences of any special character by one
            $k = str_replace(' ','-',$k);
            $k = preg_replace('/([^a-z0-9])(?=\1)/','',$k);
            $k = trim($k,'-');
            return $k;
        };
    }
    $ret = [];
    $str = trim($str);
    $str = str_replace('=>','=>'.PHP_EOL,$str);
    $lines = explode(PHP_EOL,$str);
    $last_content = '';
    $last_key = false;
    foreach($lines as $line){
        $line = trim($line);
        #### skip empty lines
        if(empty($line)){
            continue;
        }
        #### new key?
        if(substr($line,-2) == '=>'){
            if($last_key !== false){
                #### last key is done
                $ret[$last_key] = trim($last_content);
                $last_content = '';
            }
            $key = substr($line,0,-2);
            $key = $key_filter_func($key);
            $last_key = $key;
            continue;
        }
        #### ignore content before a key
        if($last_key == null){
            continue;
        }
        #### gather content
        $last_content .= $line . ' ';
    }
    #### set the last key => value
    $ret[$last_key] = $last_content;
    #### remove empty keys (after filtered)
    $ret = array_filter($ret);
    $ret = array_map('trim',$ret);
    #### finally return result
    return $ret;
}