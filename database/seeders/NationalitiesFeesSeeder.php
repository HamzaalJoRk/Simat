<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;
use App\Models\Fee;

class NationalitiesFeesSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            "تركيا",
            "العراق",
            "قطر",
            "السعودية",
            "اندونيسيا",
            "السنغال",
            "أرمينيا",
            "فنزويلا",
            "تشيلي",
            "اليابان",
            "روسيا",
            "كوريا الجنوبية",
            "كولومبيا",
            "البرازيل",
            "قبرص",
            "افريقيا الوسطى",
            "الأورغواي",
            "ألبانيا",
            "البوسنة والهرسك",
            "الرأس الأخضر",
            "المكسيك",
            "النيجر",
            "الهند",
            "بنين",
            "بوركينافاسو",
            "تركمنستان",
            "تيمور الشرقية",
            "جمايكا",
            "جزر القمر",
            "غرينادا",
            "اثيوبيا",
            "فانواتو",
            "كوت ديفوار",
            "جورجيا",
            "لوكسمبورغ",
            "رواندا",
            "زامبيا",
            "زيمبابوي",
            "سنغافورة",
            "سوازيلاند",
            "سورينام",
            "غامبيا",
            "غويانا",
            "غينيا",
            "لاوس",
            "ليبيا",
            "ليبيريا",
            "مالاوي",
            "مالي",
            "تايلاند",
            "موزامبيق",
            "ميانمار",
            "نيبال"
        ];

        $feesData = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 50],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 75],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 100],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 25],
        ];

        foreach ($countries as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData as $fee) {
                Fee::updateOrCreate(
                    [
                        'nationality_id' => $nationality->id,
                        'type' => $fee['type'],
                        'duration' => $fee['duration'],
                        'entry_count' => $fee['entry_count'],
                    ],
                    [
                        'amount' => $fee['amount'],
                    ]
                );
            }
        }
    }
}
