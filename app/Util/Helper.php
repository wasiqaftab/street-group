<?php


namespace App\Util;


class Helper
{
    /**
     * @param string $filename
     * @param string $delimiter
     *
     * @return array|false
     */
    public static function ConvertCsvToArray($filePath = '', $array=array('delimiter' => ',')) : array
    {
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return false;
        }

        $csvData = array();
        $file_handle = fopen($filePath, 'r');
        while (!feof($file_handle)) {

            $csvData[] = fgetcsv($file_handle, 0, $array['delimiter']);

        }
        fclose($file_handle);

        return $csvData;
    }

}
