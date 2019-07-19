<?php
/**
 * Created by PhpStorm.
 * User: amirreza
 * Date: 5/10/19
 * Time: 4:00 PM
 */
/**
 * Convert Latin numbers to persian numbers and vice versa
 *
 * @param string $string
 * @param boolean $toEnglish, default is false to save compatiblity
 * @return string
 */
if (! function_exists('convertNumbers')) {
    function convertNumbers($string, $toLatin = false)
    {
        $farsi_array = array("۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹");
        $english_array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        if (!$toLatin) {
            return str_replace($english_array, $farsi_array, $string);
        }
        return str_replace($farsi_array, $english_array, $string);
    }
}

if (! function_exists('numberToMonthName')) {
    function monthNumberToMonthName($number)
    {
        $month_names = [
            "فروردین",
            "اردیبهشت",
            "خرداد",
            "تیر",
            "مرداد",
            "شهریور",
            "مهر",
            "آبان",
            "آذر",
            "دی",
            "بهمن",
            "اسفند"
        ];

        return $month_names[$number - 1];
    }
}