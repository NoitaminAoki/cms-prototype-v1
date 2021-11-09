<?php

namespace App\Helpers;

class SectorData
{
    private static $datas = [
        'ID-DIY' => [
            'city' => 'Yogyakarta',
            'name' => 'Griya Amarta Girimulyo',
            'db_name' => 'cms_prototype_v1_db',
            'directory' => 'ID-DIY',
        ],
        'ID-SRG' => [
            'city' => 'Serang',
            'name' => 'Griya Amarta Pamarayan',
            'db_name' => 'cms_prototype_v1_db_2',
            'directory' => 'ID-SRG',
        ],
        'ID-SKB' => [
            'city' => 'Sukabumi',
            'name' => 'Griya Amarta Cikembar',
            'db_name' => null,
            'directory' => 'ID-SKB',
        ],
        'ID-BDG' => [
            'city' => 'Bandung',
            'name' => 'Griya Amarta Ciherang',
            'db_name' => null,
            'directory' => 'ID-BDG',
        ],
        'ID-JGL' => [
            'city' => 'Jonggol',
            'name' => 'Griya Amarta Jonggol',
            'db_name' => null,
            'directory' => 'ID-JGL',
        ],
        'ID-PSN' => [
            'city' => 'Pasuruan',
            'name' => 'Griya Amarta Rembang',
            'db_name' => null,
            'directory' => 'ID-PSN',
        ],
        'ID-GTO' => [
            'city' => 'Gorontalo',
            'name' => 'Griya Amarta Utama',
            'db_name' => null,
            'directory' => 'ID-GTO',
        ],
    ];
    
    public static function getAllNames()
    {
        return collect(self::$datas)->map(fn($val, $key) => $val['name'])->toArray();
    }

    public static function getAllDatabases()
    {
        $data = [];
        foreach (self::$datas as $key => $value) {
            if ($value['db_name']) {
                $data[] = $value['db_name'];
            }
        }
        
        return $data;
    }

    public static function getNameById($sector_id)
    {
        return self::$datas[$sector_id]['name'] ?? null;
    }

    public static function getPropertiesById($sector_id)
    {
        return self::$datas[$sector_id] ?? null;
    }
    
}