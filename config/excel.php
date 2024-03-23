<?php
use Maatwebsite\Excel\Excel;

return [
    'import' =>  [
        'read_only' =>true,
        'ignore_empty' =>false ,
        'heading_row' => [
            'formatter' =>'slug'
        ],


    'csv' => [
        'delimiter'              => null,
        'enclosure'              => '"',
        'escape_character'       =>'\\',
        'contiguous'             =>false ,
        'input_encoding'         =>'UTF-8',

    ],



    'properties' => [
        'creator'        => 'Maatwebsite',
        'lastModifiedBy' => 'Maatwebsite',
        'title'          => 'Spreadsheet',
        'description'    => 'Default spreadsheet export',
        'subject'        => 'Spreadsheet export',
        'keywords'       => 'export, spreadsheet',
        'category'       => 'Excel',
        'manager'        => 'Maatwebsite',
        'company'        => 'Maatwebsite',
    ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default properties
    |--------------------------------------------------------------------------
    |
    | This file is for storing the default properties of the exports. You
    | can override these properties for a single export by passing the
    | properties as a second argument to the export method.
    |
    */

    'properties' => [
        'creator'        => 'Maatwebsite',
        'lastModifiedBy' => 'Maatwebsite',
        'title'          => 'Spreadsheet',
        'description'    => 'Default spreadsheet export',
        'subject'        => 'Spreadsheet export',
        'keywords'       => 'export, spreadsheet',
        'category'       => 'Excel',
        'manager'        => 'Maatwebsite',
        'company'        => 'Maatwebsite',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sheets settings
    |--------------------------------------------------------------------------
    |
    | Configure defaults for creating new sheets or loading existing sheets.
    |
    */

    'sheets' => [
        'default_properties' => [
            'auto_filter' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CSV settings
    |--------------------------------------------------------------------------
    |
    | Configure the encoding, delimiter, enclosure and line ending for CSV
    | exports.
    |
    */

    'csv' => [
        'delimiter'              => ',',
        'enclosure'              => '"',
        'line_ending'            => PHP_EOL,
        'use_bom'                => false,
        'include_separator_line' => false,
        'excel_compatibility'    => false,
    ],

];
