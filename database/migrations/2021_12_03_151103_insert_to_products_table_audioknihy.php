<?php

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertToProductsTableAudioknihy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $product = new Product;
        $product['title'] = 'Oko světa';
        $product['price'] = 22.99;
        $product['discounted_price'] = 12.99;
        $product['rating'] = 4.0;
        $product['language'] = 'český';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Mladík Rand touží po klidném životě v malé vesničce, kde by s otcem choval ovce a postupem času se mohl stát členem vesnické rady. Osud však rozhodne jinak, protože z neznámých důvodů upoutá pozornost mýtických netvorů trolloků, kteří vesnici napadnou a chtějí Randa odvléct. Rand však prchá a postupně zjištuje pravdu o tom, kým ve skutečnosti je a proč osud celého světa leží v jeho rukou. Přikloní se na stranu světla nebo temnoty? Bude jeho spásou nebo zhoubou?';
        $product['series'] = 'Kolo času';
        $product['volume'] = 1;
        $product['author'] = 'Robert Jordan';
        $product['genre'] = 'fantasy';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'FANTOM Print';
        $product['length'] = '30:02';
        $product->save();

        $image = new Image;
        $image['image'] = 'OkoSveta-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Velké hledání';
        $product['price'] = 22.99;
        $product['rating'] = 3.8;
        $product['language'] = 'český';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Mladík Rand má předurčeno stát se Drakem Znovuzrozeným. Jelikož je schopen ovládat jedinou sílu, musí zároveň prchat před Aes Sedai –ženami, jež dlouhá staletí stráží svět před podobnými muži. A k tomu všemu se znovu objevil Valerský roh, artefakt z dávných časů, který je schopen rozhodnout válku mezi Světlem a Temnotou. Podaří se jej Randovi a jeho přátelům získat dřív, než jej temní služebníci předají svým pánům?';
        $product['series'] = 'Kolo času';
        $product['volume'] = 2;
        $product['author'] = 'Robert Jordan';
        $product['genre'] = 'fantasy';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'FANTOM Print';
        $product['length'] = '26:37';
        $product->save();

        $image = new Image;
        $image['image'] = 'VelkeHledani-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Drak znovuzrozený';
        $product['price'] = 20.99;
        $product['discounted_price'] = 15.99;
        $product['rating'] = 3.8;
        $product['language'] = 'český';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Drak Znovuzrozený – dávno předpovězený vůdce, jenž má zachránit svět, a zároveň ho zničit. Zachránce, jenž má zešílet a pobít ty, které miluje, je na útěku před svým osudem. Je schopen se dotknout jediné síly, ale není schopen ji řídit, a jelikož ho tomu nemá kdo naučit – protože to naposledy muži uměli před tisíci lety – Rand al\'Thor ví, že se Temnému musí postavit sám. Ale jak?';
        $product['series'] = 'Kolo času';
        $product['volume'] = 3;
        $product['author'] = 'Robert Jordan';
        $product['genre'] = 'fantasy';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'FANTOM Print';
        $product['length'] = '24:51';
        $product->save();

        $image = new Image;
        $image['image'] = 'DrakZnozuzrozeny-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Stín se šíří';
        $product['price'] = 24.99;
        $product['discounted_price'] = 18.99;
        $product['rating'] = 4.6;
        $product['language'] = 'český';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Tearský Kámen, pevnost z pověstí, byla dobyta a Callandor, Meč, jenž není mečem, byl získán. Ale pro Randa al\'Thora, jenž se stal Drakem Znovuzrozeným, je to teprve začátek. Jeho přátelé i nepřátelé kují pikle a vznešený Drak studuje zapsaná proroctví a snaží se ovládnout jedinou sílu, která mu patří. Dozví se však jen to, že musí dojít k válce – válce proti Zaprodancům a všem, kteří stojí proti Draku Znovuzrozenému. A zdi věznice, v níž je držen Temný, pomalu povolují. Rand al\'Thor ví, komu se musí v konečné bitvě postavit…';
        $product['series'] = 'Kolo času';
        $product['volume'] = 4;
        $product['author'] = 'Robert Jordan';
        $product['genre'] = 'fantasy';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'FANTOM Print';
        $product['length'] = '41:18';
        $product->save();

        $image = new Image;
        $image['image'] = 'StinSeSiri-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Oheň z nebes';
        $product['price'] = 23.99;
        $product['rating'] = 4.3;
        $product['language'] = 'český';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Vyvolení jsou volní a již připravují plány na velký den návratu, kdy bude Temný opět volně kráčet po zemi. A nedílnou součástí jejich plánu je polapení Draka Znovuzrozeného. Elaida, nově jmenovaná amyrlin Aes Sedai, také pomýšlí na polapení Draka Znovuzrozeného. Ví, že se Temný každou chvíli osvobodí, že se blíží Poslední bitva a že Drak Znovuzrozený se jí musí zúčastnit, aby se Temnému postavil, jinak je svět odsouzen k ohni a zkáze. Elaida musí zajistit, že Drak Znovuzrozený půjde na svou předpovězenou smrt. A Rand al‘Thor, sám Drak, skrytý ve starobylém městě Rhuidean, čeká, až se pod jeho zástavou shromáždí válečné klany Aielů…';
        $product['series'] = 'Kolo času';
        $product['volume'] = 5;
        $product['author'] = 'Robert Jordan';
        $product['genre'] = 'fantasy';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'FANTOM Print';
        $product['length'] = '36:34';
        $product->save();

        $image = new Image;
        $image['image'] = 'OhenZNebes-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();


        $product = new Product;
        $product['title'] = 'Pán chaosu';
        $product['price'] = 24.99;
        $product['rating'] = 4.1;
        $product['language'] = 'český';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Jak se kolo času otáčí, dují zemí větry osudu a Rand al‘Thor se snaží sjednotit státy k Poslední bitvě, k níž dojde, až se Temný konečně osvobodí, a zničit pasti, které nesmrtelní Zaprodanci nachystali na důvěřivé lidstvo.
        Bílá věž v Tar Valonu pod vedením amyrlin Elaidy rozhodla, že Randa je třeba ovládnout – v nejnutnějším případě zkrotit – a to okamžitě. A v Salidaru, mezi Ales Sedai ve vyhnanství, Egwain dostane předvolání před nejvyšší radu, a přitom ví, že se ho její kolegyně také snaží spoutat. Sucho a letní žár přetrvávají do zimy a Nyneiva s Elain, dědičkou Andoru, se v zoufalství vydávají hledat bajný ter\'angrial, jenž by jim mohl pomoci nastolit normální počasí – a jejich hledání je zavádí mezi bělokabátníky, kteří hodlají všechny Aes Sedai smést z povrchu zemského.
        A na druhé polovině kontinentu Perrin Aybara cítí, jak ho Rand k sobě přitahuje, jako jeden ta\'veren druhého, a poprvé a tisíc let se lučištníci z Dvouříčí vydávají do války.';
        $product['series'] = 'Kolo času';
        $product['volume'] = 6;
        $product['author'] = 'Robert Jordan';
        $product['genre'] = 'fantasy';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'FANTOM Print';
        $product['length'] = '41:37';
        $product->save();

        $image = new Image;
        $image['image'] = 'PanChaosu-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Da Vinciho kód';
        $product['price'] = 13.99;
        $product['discounted_price'] = 9.99;
        $product['rating'] = 4.0;
        $product['language'] = 'slovenský';
        $product['type'] = 'audiokniha';
        $product['description'] = 'V parížskom Louvri nájdu mŕtvolu muža a pri ňom záhadnú šifru v podobe pentagramu, pripomínajúcu najslávnejšiu kresbu Leonarda da Vinci. Americký vedec, odborník na symboliku Robert Langdon a pôvabná francúzska kryptologička Sophie sa podujmú záhadu rozlúštiť a začína sa ich dobrodružná misia plná vzrušujúcich a nebezpečných odhalení.
        Zavraždený kurátor múzea bol, podobne ako mnohé významné osobnosti v dejinách, členom Priorstva Sionu, spoločenstva, ktorého poslaním je chrániť jedno z najväčších tajomstiev tohto sveta. Hrozí, že toto tajomstvo čoskoro môže vyjsť najavo, a tomu treba za každú cenu zabrániť, pretože následky by mohli byť nepredstaviteľné. Vedecké bádanie sa tak dostáva do ostrého konfliktu so záujmami cirkvi aj s náboženským fanatizmom a v hre je odrazu všetko, aj holý život.';
        $product['series'] = 'Robert Langdon';
        $product['volume'] = 2;
        $product['author'] = 'Dan Brown';
        $product['genre'] = 'triler';
        $product['age_group'] = 'od 18 rokov';
        $product['publisher'] = 'Slovart';
        $product['length'] = '11:36';
        $product->save();

        $image = new Image;
        $image['image'] = 'DaVinci-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Stratený symbol';
        $product['price'] = 9.99;
        $product['rating'] = 2.7;
        $product['language'] = 'slovenský';
        $product['type'] = 'audiokniha';
        $product['description'] = 'V románe nič nie je také, ako sa na prvý pohľad zdá. Príbeh tejto knihy sa odohráva v časovom rámci 12 hodín a od prvej strany Danovi čitatelia pocítia hrôzu pritom, ako budú sledovať suverénneho Roberta Langdona pri jeho novom objave v nečakanom, novom prostredí. Stratený symbol je plný prekvapení.';
        $product['series'] = 'Robert Langdon';
        $product['volume'] = 3;
        $product['author'] = 'Dan Brown';
        $product['genre'] = 'triler';
        $product['age_group'] = 'od 18 rokov';
        $product['publisher'] = 'Slovart';
        $product['length'] = '17:48';
        $product->save();

        $image = new Image;
        $image['image'] = 'StratenySymbol-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Ready Player One';
        $product['price'] = 14.99;
        $product['discounted_price'] = 11.99;
        $product['rating'] = 3.5;
        $product['language'] = 'slovenský';
        $product['type'] = 'audiokniha';
        $product['description'] = 'V roku 2044 je svet veľmi nehostinné miesto. Minula sa ropa, klíma je zničená, rozšíril sa hladomor, chudoba a choroby.
        Stredoškolák Wade Watts, tak ako väčšina ľudstva, uniká pred bezútešnou realitou do virtuálnej utópie zvanej OASIS, kde môže byť, kým len chce. Existujú tu tisíce planét, na ktorých sa dá žiť, hrať, ale aj zamilovať. A rovnako ako ostatní, aj Wade je posadnutý hľadaním zlatého vajca, špeciálneho bonusu, ukrytého v tejto alternatívnej realite.';
        $product['series'] = 'Ready Player One';
        $product['volume'] = 1;
        $product['author'] = 'Ernest Cline';
        $product['genre'] = 'sci-fi';
        $product['age_group'] = 'od 12 rokov';
        $product['publisher'] = 'Ikar';
        $product['length'] = '15:41';
        $product->save();

        $image = new Image;
        $image['image'] = 'ReadyPlayerOne-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Päť týždňov v balóne';
        $product['price'] = 18.99;
        $product['discounted_price'] = 10.99;
        $product['rating'] = 3.1;
        $product['language'] = 'slovenský';
        $product['type'] = 'audiokniha';
        $product['description'] = 'V prvom príbehu Julesa Verna chce sangvinický doktor s jeho skeptickým škótskym priateľom Kennedym a verným sluhom Joeom prejsť svojim originálnym balónom väčšiu časť Afriky a tým potvrdiť, prebádať a zhrnúť prieskumy Afriky od predchádzajúcich cestovateľov (David Livingstone). Z Anglicka ich odvezie loď cez Mys dobrej nádeje na Zanzibar. Koniec trasy v Afrike bude niekde v juhozápadnej Sahare. Skvelý príbeh s hocijakými skúškami a s "balónovými" dobrodružstvami.';
        $product['author'] = 'Jules Verne';
        $product['genre'] = 'dobrodružné';
        $product['age_group'] = 'od 10 rokov';
        $product['publisher'] = 'Mladé letá';
        $product['length'] = '8:18';
        $product->save();

        $image = new Image;
        $image['image'] = 'Balon-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Odviate vetrom';
        $product['price'] = 24.99;
        $product['discounted_price'] = 12.99;
        $product['rating'] = 4.1;
        $product['language'] = 'slovenský';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Dramatický ľúbostný príbeh Scarlett O´Harovej a Rhetta Butlera z americkej občianskej vojny dojímal i provokoval celé generácie čitateľov a dodnes patrí k najčítanejším románom. Scarlett, krásnu, rozmaznanú, tvrdohlavú dcéru plantážnika vychovávajú ako pravú južanskú dámu, ktorá sa má podriaďovať prísnym spoločenským zvyklostiam a tradíciám. Jej výbušná povaha sa však proti týmto putám vzbúri, keď sa zaľúbi do romantického Ashleyho Wilkesa a rozhodne sa ho získať za každú cenu napriek tomu, že je zasnúbený s inou ženou.';
        $product['author'] = 'Margaret Mitchellová';
        $product['genre'] = 'romantické';
        $product['age_group'] = 'od 15 rokov';
        $product['publisher'] = 'Ikar';
        $product['length'] = '15:34';
        $product->save();

        $image = new Image;
        $image['image'] = 'OdviateVetrom-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Ottova obrazová encyklopédia - Zem';
        $product['price'] = 34.99;
        $product['discounted_price'] = 26.99;
        $product['rating'] = 4.5;
        $product['language'] = 'slovenský';
        $product['type'] = 'audiokniha';
        $product['description'] = 'Ottova obrazová encyklopédia - Zem približuje minulosť, súčasnosť a pravdepodobnú budúcnosť zatiaľ jedinej živej planéty. Vznik planéty Zem a jej miesto vo vesmíre. Podrobnosti o vzniku života a priebehu postupného osídľovania rastlinami, živočíchmi až po súčasnosť. Prehľad a vznik všetkých typov životného prostredia. Vplyv ľudskej činnosti na planétu Zem. Celosvetová spolupráca pri ochrane životného prostredia.';
        $product['author'] = 'Michael Allaby';
        $product['genre'] = 'encyklopédia';
        $product['publisher'] = 'Ottovo nakladatelství';
        $product['age_group'] = 'od 6 rokov';
        $product['length'] = '22:48';
        $product->save();

        $image = new Image;
        $image['image'] = 'Zem-Audio.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
