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
            "الجزائر",
            "كوبا",
            "مصر",
            "باكستان",
            "تنزانيا",
            "الصين",
            "ترينيداد وتوباغو",
            "أذربيجان",
            "البيرو",
            "الجبل الأسود",
            "المغرب",
            "أنغولا",
            "بوتسوانا",
            "تشاد",
            "سيريلانكا",
            "طاجكستان",
            "كمبوديا",
            "منغوليا",
            "موريشيوس",
            "ناميبيا",
            "الأكوادور",
            "توفالو",
            "السودان",
            "اليمن",
            "السيشل",
        ];

        $feesData = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 25],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 40],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 50],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 15],
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


        $countries_therd = [
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
            "نيبال",
        ];

        $feesData_therd = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 50],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 75],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 100],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 25],
        ];

        foreach ($countries_therd as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_therd as $fee) {
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


        $countries_therd = [
            "جنوب افريقيا",
            "النمسا",
            "رومانيا",
            "هنغاريا",
            "اليونان",
            "سويسرا",
            "بيلاروسيا",
            "بلجيكا",
            "السويد",
            "فرنسا",
            "ألمانيا",
            "تونس",
            "اسبانيا",
            "الباراغواي",
            "هولندا",
            "بلغاريا",
            "سلطنة عمان",
            "الفلبين",
            "البحرين",
            "البرتغال",
            "الدنمارك",
            "الصومال",
            "النرويج",
            "ايسلندا",
            "إيطاليا",
            "بولونيا",
            "التشيك",
            "سلوفاكيا",
            "سلوفانيا",
            "غينيا بيساو",
            "فنلندا",
            "كازاخستان",
            "الباهاما",
            "لاتفيا",
            "ليتوانيا",
            "ليسوتو",
            "مالطا",
            "مولدوفا",
            "مقدونيا",
        ];

        $feesData_therd = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 75],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 110],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 150],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 40],
        ];

        foreach ($countries_therd as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_therd as $fee) {
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


        $countries_four = [
            "الإمارات",
            "أوغندا",
            "جيبوتي",
            "سيراليون",
            "كندا",
        ];

        $feesData_four = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 10],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 150],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 200],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 50],
        ];

        foreach ($countries_four as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_four as $fee) {
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


        $countries_fift = [
            "نيجريا",
            "بريطانيا",
            "الأرجنتين",
            "كينيا",
            "أزوبكستان",
            "أستراليا",
            "أفغانستان",
            "بوروندي",
            "الدومنيكان",
            "فيجي",
            "ساتومي",
            "الكاميرون",
            "غينيا الاستوائية",
            "غانا",
            "نيوزلندا",
        ];

        $feesData_fift = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 150],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 225],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 300],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 75],
        ];

        foreach ($countries_fift as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_fift as $fee) {
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


        $countries_sex = [
            "الولايات المتحدة الأمريكية",
            "الغابون",
            "قرغيزستان",
        ];

        $feesData_sex = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 200],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 300],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 400],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 100],
        ];

        foreach ($countries_sex as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_sex as $fee) {
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


        $countries_seven = [
            "الولايات المتحدة الأمريكية",
            "الغابون",
            "قرغيزستان",
        ];

        $feesData_seven = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 200],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 300],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 400],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 100],
        ];

        foreach ($countries_seven as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_seven as $fee) {
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


        $countries_8 = [
            "جزر المارشال",
            "الكونغو",
            "كوريا الشمالية",
        ];

        $feesData_8 = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 300],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 350],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 400],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 150],
        ];

        foreach ($countries_8 as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_8 as $fee) {
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


        $countries_9 = [
            "إيران",
        ];

        $feesData_9 = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 400],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 500],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 800],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 250],
        ];

        foreach ($countries_9 as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_9 as $fee) {
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


        $countries_10 = [
            "ايرلندا",
            "فلسطين",
            "الكويت",
            "غير موجودة",
            "بنغلادش",
            "اكرانيا",
            "كرواتيا",
            "بولندا",
            "بنما",
        ];

        $feesData_10 = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 50],
            ['type' => 'دخول', 'duration' => '3 أشهر', 'entry_count' => 'مرتين', 'amount' => 75],
            ['type' => 'دخول', 'duration' => '6 أشهر', 'entry_count' => 'متعددة', 'amount' => 100],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 25],
        ];

        foreach ($countries_10 as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_10 as $fee) {
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
        
        
        $countries_11 = [
            "لبنان",
        ];

        $feesData_11 = [
            ['type' => 'دخول', 'duration' => 'شهر', 'entry_count' => 'مرة واحدة', 'amount' => 50],
            ['type' => 'مرور', 'duration' => '15 يوم', 'entry_count' => 'مرة واحدة', 'amount' => 50],
        ];

        foreach ($countries_11 as $countryName) {
            $nationality = Nationality::firstOrCreate(['name' => $countryName]);

            foreach ($feesData_11 as $fee) {
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
