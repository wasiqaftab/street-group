<?php


namespace App\Util;



class NameParser {


    /**
     * Extract the elements of the full name into separate parts.
     *
     * @access public
     */
    public function parse($string) {
        // reset values
        $arr = explode(' ', $string);
        $num = count($arr);
        $title = $first_name = $middle_name = $last_name = null;

        if ($num == 3) {

            if(strlen($arr[1]) <= 1)
            {
                [$title,$middle_name,$last_name] = $arr;
            }
            else
            {
                [$title,$first_name,$last_name] = $arr;
            }

        } else {

            $key = array_search('&', $arr, true);
            if ($key !== false) {
                unset($arr[$key]);
                $arr=array_values($arr);
            }

            // if and comes find it and than split the array into 2 parts
            $key = array_search('and', $arr, true);
            if ($key !== false) {
                // print_r(array_chunk($arr, 2));
                $split_by = array_search('and', $arr, true);
                if ($split_by) {
                    $first = array_slice
                    ($arr, 0, $split_by );
                    $second = array_slice
                    ($arr, $split_by + 1);
                }
                unset($arr[$key]);
                $arr=array_values($arr);
            }


                if(strtolower($arr[1])==='mrs') {

                    $dublicate_array = $arr;
                    unset($arr[1]);
                    $arr=array_values($arr);
                    if(count($arr)===2)
                    {
                        [$title, $last_name] = $arr;
                    }
                    else
                    {
                        [$title, $first_name, $last_name] = $arr;
                    }


                    $arr=$dublicate_array;

                    unset($arr[0]);
                    $arr=array_values($arr);
                    if(count($arr)===2)
                    {
                        [$title, $last_name] = $arr;
                    }
                    else
                    {
                        [$title, $first_name, $last_name] = $arr;
                    }

                    $array_merge = array_merge([$title, $first_name, $middle_name, $last_name],[$title, $first_name, $middle_name, $last_name]);

                    return array (
                        'title' => $array_merge[0],
                        'first_name' => $array_merge[1],
                        'middle_name' => null,
                        'last_name' =>$array_merge[3],
                        'title_1' => $array_merge[4],
                        'first_name_1' => $array_merge[5],
                        'middle_name_1' => null,
                        'last_name_1' =>$array_merge[7],
                    );
                }
                else
                {
                    [$title, $first_name, $middle_name, $last_name] = $arr;
                }

        }

        return (empty($title) || $num > 8) ? false : compact(
            'title','first_name', 'middle_name', 'last_name'
        );
    }
}
