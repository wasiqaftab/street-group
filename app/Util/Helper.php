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
    public static function csvToArray($filePath = '', $delimiter = ',') : array
    {
        if (!file_exists($filePath) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }

}
