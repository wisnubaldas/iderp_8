<?php
namespace App\Library;
class MyHelper {
    public function __construct() {
        
    }
    public static function include_route_files($folder)
    {
        try {
            $rdi = new \RecursiveDirectoryIterator($folder);
            $it = new \RecursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public static function get_dir_name(string $dir)
    {
        $folderName = scandir(database_path($dir));
        unset($folderName[0]);
        unset($folderName[1]);
        return array_values($folderName);
    }
    public static function get_csv(string $data)
    {
        $result = [];
        $handle = fopen($data, "r");
        while (($data = fgetcsv($handle)) !== FALSE) {
            array_push($result,$data);
        }
        // return fgetcsv($handle);
        fclose($handle);
        return $result;
    }
}