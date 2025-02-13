<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('abouts')->insert([
            [
                'about_ar' => 'مارينا بوست موقع الكتروني اجتماعي متنوع يتميز بمحتوى صادق وشفاف ويحتوي على العديد من المقالات المتنوعة والاخبار الفريدة من نوعها والمميزة .التي تهم زائرينا الكرام والتي يعنى بها جمهورنا 
هل تعرف أدوات أو تطبيقات أو موارد صحفية لم نقم بتغطيتها ولم ننشر مقالات عنها؟ هل أنت من المبتكرين الإعلاميين ولديك فكرة مميّزة تُريد أن تخبر الصحفيين بها؟ أو هل تريد مناقشة الاتجاهات الإعلامية الحالية في بلدك؟
إذا كانت إجابتك نعم عن أي من الأسئلة السابقة.. إذًا نحن هنا لنسمعك!
تستقبل شبكة الصحفيين الدوليين الأفكار من القرّاء، فنحن نأمل بأن نبني شبكة من الكتاب العالميين والمتنوعين الذين يمكن أن تساعد أعمالهم أكبر عدد ممكن من الصحفيين، ومن أجل إرسال الأفكار والفرص يمكنكم التواصل معنا، وقبل تعبئة النموذج في أسفل الصفحة، يرجى أن تكونوا على اطلاع على المحتوى الذي يُنشر على موقع الشبكة.
',

                'about_en' => 'Marina Post is a website and social media agency characterized by honest and transparent content and contains many diverse articles and unique and distinctive news that are of interest to our esteemed visitors and of which our audience is interested.
',
                'objective_ar' => 'إيصال المعلومات الى المتابع في وقت قياسي 
شبكة الصحفيين الدوليين هي مرجع ومورد للصحفيين، وتركّز في المحتوى على كلّ ما يهم الصحفيين، كما أثّرت بالمسيرة الصحفية لكثيرين، يمكنكم الإطلاع على مثل عبر الضغط هنا وهنا.
تجدون فيما يلي مقالات ونماذج عن المواضيع التي نتطرّق لها:
- نصائح على شكل قائمة، يمكنكم الإطلاع على مثل عبر الضغط هنا وهنا.
- أدوات تهم الصحفيين، يمكنكم الإطلاع على مثل عبر الضغط هنا وهنا.
-دراسة حالة، يمكنكم الإطلاع على مثل عبر الضغط هنا.
-بحث متعمق في الصحافة، يمكنكم الإطلاع على مثل عبر الضغط هنا وهنا.
-حدث إعلامي أو مشروع صحفي.
إذا وجد فريق شبكة الصحفيين الدوليين أنّ فكرتك جديرة بالتطوير، سيتمّ الرد عليك!
وإذا كنت مترددًا وتريد معرفة كيفية عرض أفكار لإعداد تقارير لشبكتنا، إضغط هنا. 
قدّم فكرتك عبر الضغط هنا
',

                'objective_en' => 'Delivering information to the follower in record time',


                'mission_ar' => 'وصول الاخبار والمقالات الى  مستوى عالمي 
نقدم مجموعة واسعة من المزايا التي تجعل من عملك معنا هو الأفضل على الإطلاق
•	الحصول على مردود مالي  من اعدادك لتقرير صحفي او خبر صحفي مميز 
•	شهرة التي يحصل عليها الصحفي بنطاق واسع في بلدة وخارج للعالمبية 
',


                'mission_en' => 'News and articles reach a global level
We offer a wide range of benefits that make your work with us the best ever
• Get a financial return from preparing a distinguished press report or news
• The fame that the journalist gains on a wide scale in his country and outside the world

',


                'vission_ar' => 'كتابة اخبار ومقالات يعنى بها الجمهور ',


                'vission_en' => 'Writing news and articles of interest to the public
',
                'goal_ar' => 'الشفافية . المصداقية . اخبار على مدار الساعة .ومقالات مميزة ومتنوعة 
القيم
•	النزاهة والاحترام يوجهان سلوكنا في داخل الشبكة وخارجها.
•	نقف مع الناس ونروي قصص حقيقية.
•	نشجع روح الريادة.
•	نحافظ على المصداقية من خلال الحيادية والدقة في تقصي ونقل الحدث.
•	نسعى جاهدين للتميُّز في كل ما نقوم به.
•	توصيل احداث بلدك للعالم بكل مصداقية
',
                'goal_en' => 'Transparency . Credibility. News around the clock and distinctive and diverse articles
• Integrity and respect guide our behavior on and off the network.
• We stand with people and tell real stories.
• We encourage entrepreneurship.
• We maintain credibility through impartiality and accuracy in reporting and reporting events.
• We strive for excellence in everything we do.
• Communicate your country’s events to the world with complete credibility
',
                'image' => '../asset/img/extra/marina.png',
                'created_at' => now(),
                'updated_at' => now(),

            ]
        ]);
    }
}
