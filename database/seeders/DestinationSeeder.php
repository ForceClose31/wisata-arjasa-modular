<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Destination\Models\Destination;
use Modules\Destination\Models\DestinationCategory;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $category = DestinationCategory::firstOrCreate([
            'name' => ['en' => 'Cultural', 'id' => 'Budaya']
        ]);

        $destinations = [
            [
                'title' => [
                    'en' => 'Wisata Citra Mandiri Waterpark',
                    'id' => 'Wisata Citra Mandiri Waterpark'
                ],
                'description' => [
                    'en' => 'It is a waterpark with the concept of family and children. It is equipped with special facilities (disability), so that it becomes an ideal destination for family vacations. This tourist destination is located in Tegalbago Hamlet.',
                    'id' => 'Merupakan tempat wisata air/ waterpark dengan mengusung konsep keluarga dan ramah anak. Serta dilengkapi fasilitas khusus (disabilitas ), sehingga menjadi daya tarik yang sangat ideal untuk liburan keluarga. Wisata ini berlokasi di Dusun Tegalbago.'
                ],
                'facilities' => [
                    'en' => ['Children\'s swimming pool', 'Adult swimming pool', 'Playground', 'Parking area', 'Gazebo', 'Archery range', 'Toilet', 'Lactation room (Breastfeeding room)', 'Canteen managed by UMKM.'],
                    'id' => ['Kolam renang anak', 'Kolam renang dewasa', 'Taman bermain', 'Area parkir', 'Gazebo', 'Tempat panahan', 'Toilet', 'Ruang laktasi (Ruang menyusui)', 'Kantin yang dikelola oleh  UMKM']
                ],
                'location' => [
                    'en' => 'Tegalbago Hamlet',
                    'id' => 'Dusun Tegalbago'
                ],
                'image' => 'destinations/waterpark.jpg'
            ],
            [
                'title' => [
                    'en' => 'Situs Calok',
                    'id' => 'Situs Calok'
                ],
                'description' => [
                    'en' => 'Megalithic heritage relics of the stone age era consisting of Batu Kenong, Dolmen, and Menhir. Guided by a local guide, visitors will get a detailed explanation of these historical relics. This tourist destination is located in Padukuhan Kangkong, Calok Hamlet.',
                    'id' => 'Peninggalan cagar budaya megalithikum era zaman batu tengah terdiri dari Batu Kenong, Dolmen dan Menhir. Dipandu pemandu lokal dengan penjelasan rinci. Berlokasi di Padukuhan Kangkong, Dusun Calok.'
                ],
                'facilities' => [
                    'en' => ['Local guide'],
                    'id' => ['Pemandu lokal']
                ],
                'location' => [
                    'en' => 'Calok Hamlet',
                    'id' => 'Dusun Calok'
                ],
                'image' => 'destinations/calok.jpg'
            ],
            [
                'title' => [
                    'en' => 'Punden Berundak',
                    'id' => 'Punden Berundak'
                ],
                'description' => [
                    'en' => 'One of the remaining punden in the Hyang Argopuro Mountains slope area that holds the history of the Hyang civilization. This tourist destination is a heritage of megalithic culture. Visitors will be guided by local tour guides to find out the history and function of the stepped punden. This tourist destination is located in Tegalbago Hamlet.',
                    'id' => 'Merupakan salah satu punden yang masih ada di wilayah lereng Pegunungan Hyang Argopuro dan menyimpan sejarah peradaban Hyang. Destinasi ini merupakan peninggalan cagar budaya megalithikum. Pengunjung akan dipandu oleh pemandu wisata lokal untuk mengetahui sejarah serta fungsi dari punden berundak. Destinasi wisata ini berlokasi di Dusun Tegalbago.'
                ],
                'facilities' => [
                    'en' => ['Local guide'],
                    'id' => ['Pemandu lokal']
                ],
                'location' => [
                    'en' => 'Tegalboto Hamlet',
                    'id' => 'Dusun Tegalbago'
                ],
                'image' => 'destinations/punden.jpg'
            ],
            [
                'title' => [
                    'en' => 'Kampung Wisata Kesseh Gumitir',
                    'id' => 'Kampung Wisata Kesseh Gumitir'
                ],
                'description' => [
                    'en' => 'This tourist destination offers education in making rice containers made of woven bamboo called “Kesseh”. Kesseh in Madurese means bamboo rice bowl. Visitors can learn to weave bamboo (Kesseh) and be guided by the local community in weaving bamboo. This tourist destination is located in Gumitir Hamlet.',
                    'id' => 'Destinasi wisata ini menawarkan edukasi membuat tempat nasi yang terbuat dari anyaman bambu yang disebut “Kesseh”. Kesseh dalam bahasa Madura berarti tempat nasi dari bambu. Pengunjung bisa belajar menganyam bambu (Kesseh) dan dibimbing oleh masyarakat setempat dalam menganyam bambu. Destinasi wisata ini berada di Dusun Gumitir.'
                ],
                'facilities' => [
                    'en' => ['Visitors can learn to weave bamboo (Kesseh) and be guided by the local community in weaving bamboo'],
                    'id' => ['Belajar menganyam bambu (Kesseh) dan dibimbing oleh masyarakat setempat dalam menganyam bambu']
                ],
                'location' => [
                    'en' => 'Gumitir Hamlet',
                    'id' => 'Dusun Gumitir'
                ],
                'image' => 'destinations/kesseh.jpg'
            ],
            [
                'title' => [
                    'en' => 'Gallery Lukis Bakar',
                    'id' => 'Gallery Lukis Bakar'
                ],
                'description' => [
                    'en' => 'One of the unique aspects of Desa Wisata Adat Arjasa is the craftsmanship that comes from wood waste. The skillful hands of local artists in Desa Wisata Adat Arjasa can transform wood waste into beautiful and natural burnt paintings. Using the phyrograph technique, the artists make paintings, which are mostly face paintings poured on canvas in the form of wooden sheets, into a very beautiful and interesting work of art. In this tourist destination, visitors can see a collection of grilled paintings in the gallery. The gallery is located in Krajan Hamlet.',
                    'id' => 'Salah satu keunikan dari Desa Wisata Adat Arjasa adalah karya ekraft yang berasal dari limbah kayu. Tangan-tangan terampil seniman lokal Desa Wisata Adat Arjasa,   mampu mengubah limbah kayu menjadi karya lukis bakar yang indah dan natural. Dengan  menggunakan teknik phyrograph,   para seniman membuat lukisan yang sebagian besar berupa lukisan wajah dituangakan dalam kanvas yang berupa lembaran kayu menjadi sebuah karya seni yang yang sangat indah dan menarik. Pada destinasi wisata ini, pengunjung dapat melihat koleksi lukis bakar yang ada di galeri. Galeri ini berlokasi di Dusun Krajan.'
                ],
                'facilities' => [
                    'en' => ['See a collection of grilled paintings in the gallery.'],
                    'id' => ['Melihat koleksi lukis bakar di galeri']
                ],
                'location' => [
                    'en' => 'Krajan Hamlet',
                    'id' => 'Dusun Krajan'
                ],
                'image' => 'destinations/lukis.jpg'
            ],
            [
                'title' => [
                    'en' => 'Sendang Tirta Amertha Rajasa',
                    'id' => 'Sendang Tirta Amertha Rajasa'
                ],
                'description' => [
                    'en' => 'Is one of the places where the Mendhak Tirta Manggala Hyang Ritual and the Idher Bhumi Ritual are held once a year, every mid-September. This place is also a part of a ritual where Hindus usually perform a procession of purifying themselves, or melukat. There are also relics of classical era cultural heritage here. This tourist destination is located in Bendelan Hamlet.',
                    'id' => 'Adalah salah satu tempat dilaksanakannya Ritual Mendhak Tirta Manggala Hyang dan Ritual Idher Bhumi yang dilaksanakan setahun sekali setiap pertengahan bulan September. Tempat ini juga merupakan patirtan yang biasanya umat Hindu melakukan prosesi menyucikan diri atau melukat. Di sini juga ada peninggalan cagar budaya era klasik. Destinasi wisata ini berlokasi di Dusun Bendelan.'
                ],
                'facilities' => [
                    'en' => ['Toilets', 'Notice Board', 'Name Board'],
                    'id' => ['Toilet', 'Papan Himbauan', 'Name Board']
                ],
                'location' => [
                    'en' => 'Bendelan Hamlet',
                    'id' => 'Dusun Bendelan'
                ],
                'image' => 'destinations/sendang.jpg'
            ],
            [
                'title' => [
                    'en' => 'Arjasa Village Art Studio',
                    'id' => 'Sanggar Seni Desa Arjasa'
                ],
                'description' => [
                    'en' => 'Is a place for performing arts activities. Here, there is a stage for Ta\' bhutaan art performances, and a typical Hyang cultural house equipped with a digital museum containing information on cultural heritage, customs, typical arts, traditions, and culinary specialties of Desa Wisata Adat Arjasa. This tourist destination is located in Krajan Hamlet.',
                    'id' => 'Merupakan tempat aktifitas pertunjukan seni. Disini, terdapat panggung pertunjukan kesenian Ta\' bhutaan dan rumah budaya khas Hyang yang dilengkapi dengan museum digital yang berisi tentang informasi peninggalan cagar budaya, adat istiadat, kesenian khas, tradisi dan kuliner khas Desa Wisata Adat Arjasa. Destinasi wisata ini berlokasi di Dusun Krajan.'
                ],
                'facilities' => [
                    'en' => ['Toilets', 'Parking area', 'Cultural house'],
                    'id' => ['Toilet', 'Area parkir', 'Rumah budaya']
                ],
                'location' => [
                    'en' => 'Krajam Hamlet',
                    'id' => 'Dusun Krajan'
                ],
                'image' => 'destinations/sanggar.jpg'
            ]
        ];

        foreach ($destinations as $destination) {
            Destination::create([
                'title' => $destination['title'],
                'description' => $destination['description'],
                'facilities' => $destination['facilities'],
                'location' => $destination['location'],
                'operational_hours' => ['en' => 'Open 24 hours', 'id' => 'Buka 24 jam'],
                'type' => ['en' => 'Public', 'id' => 'Umum'],
                'image' => $destination['image'],
                'category_id' => $category->id,
                'admin_id' => 1,
                'slug' => Str::slug($destination['title']['en'] . '-' . Str::random(5)),
            ]);
        }

        $this->command->info('Successfully seeded ' . count($destinations) . ' tourist destinations.');
    }
}
