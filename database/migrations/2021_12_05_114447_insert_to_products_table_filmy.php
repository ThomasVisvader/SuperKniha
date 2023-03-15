<?php

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertToProductsTableFilmy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $product = new Product;
        $product['title'] = 'Kill Bill';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Bývalá členka špičkového zabijáckého komanda sa rozhodne navždy skončit s minulostí a vdát se. Její svatební den se však změní v krvavá jatka. Bývalý šéf Bill zaútočí s úmyslem ji zabít… Všichni si myslí, že je mrtvá, mladá žena však šťastnou náhodou vražedný útok prežije, jen upadne do kómatu. Po pěti letech se vrací z temného prahu smrti s jedinou myšlenkou: pomstít se všem, kteří jí ublížili, bez ohledu na to, co je k tomu vedlo.';
        $product['rating'] = 4.0;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Kill Bill';
        $product['volume'] = 1;
        $product['author'] = 'Quentin Tarantino';
        $product['genre'] = 'akčný';
        $product['length'] = '1:51:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'KillBill.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Pán prstenů - Společenstvo prstenu';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'V dávných dobách byl vykován kouzelný prsten, který vlastnil pán Mordoru Sauron. Jeho moc začal využívat k šíření zla, ale o prsten nakonec v boji přišel, a ten na dlouhá léta zmizel. Nakonec ho našel hobit Bilbo Pytlík, který díky němu přestal stárnout. Na naléhavou žádost čaroděje Gandalfa předá prsten synovci Frodovi. Ten se svými kamarády Samem, Smíškem a Pipinem odcházejí do Hůrky a Gandalf se vydává pro radu za svým učitelem, čarodějem Sarumanem.';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Pán prstenů';
        $product['volume'] = 1;
        $product['author'] = 'Peter Jackson';
        $product['genre'] = 'fantasy';
        $product['length'] = '2:52:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Lotr1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Pán prstenů - Dvě věže';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Po smrti Boromira a rozpadu Společenstva se cesty jeho členů rozdělily. Hobbit Frodo se svým sluhou Samem putují k Hoře Osudu, jen tam mohou sprovodit ze světa obávaný Prsten moci. Musí se však vypořádat se skřetem Glumem, který se snaží Prsten ukrást, ale hobiti ho přemůžou, spoutají a donutí ho, aby je vedl k bráně Mordoru. Aragorn s elfem Legolasem a trpaslíkem Gimlim se vydávají po stopě skřetů, aby osvobodili z jejich zajetí hobbity Smíška a Pippina.';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Pán prstenů';
        $product['volume'] = 2;
        $product['author'] = 'Peter Jackson';
        $product['genre'] = 'fantasy';
        $product['length'] = '2:52:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Lotr2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Pán prstenů - Návrat krále';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Rozhodující bitva o Středozem začíná! Čaroděj Gandalf, elf Legolas a trpaslík Gimli spěchají s dědicem trůnu Aragornem na pomoc zemi Gondor, která odolává početnému Sauronovu vojsku. Armáda obránců dobra by byla poražena, nebýt toho, že Aragorn vyzval k boji po svém boku zástupy prokletých mrtvých z nitra hory. Když mu mrtví pomohou v závěrečném boji o Středozem, budou zbaveni kletby. Mezitím hobiti Frodo a Sam se v doprovodu Gluma snaží dostat hluboko do země Mordor, kde musí v ohních Hory osudu zničit magický Prsten moci.';
        $product['rating'] = 5.0;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Pán prstenů';
        $product['volume'] = 3;
        $product['author'] = 'Peter Jackson';
        $product['genre'] = 'fantasy';
        $product['length'] = '3:21:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Lotr3.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Pearl Harbor';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Nerozluční kamarádi Danny a Rafe prodělávají letecký výcvik. Rafe je přijat jako dobrovolník k elitní britské Orlí peruti. Danny považuje jeho odjezd za zradu a ještě hůře nese zprávu Rafova přítelkyně Evelyn. Zatímco Rafe odjíždí na výcvik do Anglie, situace ve světě se vyostřuje. Americký prezident Roosevelt žádá více pomoci bojujícím spojencům, japonský admirál Jamamoto zase přesvědčuje vládu, aby zasadila Američanům drtivý úder.';
        $product['rating'] = 4.2;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['author'] = 'Michael Bay';
        $product['genre'] = 'vojnový';
        $product['length'] = '2:55:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'PearlHarbor.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Piráti z Karibiku - Truhla mrtvého muže';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'V tomto dobrodružném a velkolepém pokračování filmového hitu z roku 2003, které vzniklo opět pod vedením producenta Jerryho Bruckheimera a režiséra Gorea Verbinskiho, je kapitán Jack Sparrow znovu lapen ve spletité síti záhrobních intrik. Prokletí Černé perly se mu sice podařilo zlomit, avšak nyní musí se svou posádkou čelit mnohem děsivější hrozbě - ukáže se, že Jack se upsal krví legendárnímu Davymu Jonesovi (Bill Nighy), který je vládcem oceánských hlubin a kapitánem tajemné lodě BLUDNÝ HOLANĎAN, jíž se v rychlosti a schopnosti rychlého zmizení nedokáže vyrovnat žádná jiná loď.';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Piráti z Karibiku';
        $product['volume'] = 2;
        $product['author'] = 'Gore Verbinski';
        $product['genre'] = 'dobrodružný';
        $product['length'] = '2:25:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Pirati2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'RRRrrrr!!!';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Pred 35 000 rokmi v časoch, kedy bol boj o oheň už dávno vybojovaný, prišiel na rad šampón, kvôli ktorému bol spáchaný prvý zločin v histórii ľudstva. Dva praveké kmene, Špinavovlasých a Čistovlasých žijú v harmónii a mieri až do chvíle, keď si Špinavovlasí uvedomia, že sa od susedného kmeňa líšia... Čistotou vlasov. Ale tajnú receptúru na peniacu zmes majú iba Čistovlasí a tí sa o ňu nechcú podeliť...';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['author'] = 'Alain Chabat';
        $product['genre'] = 'komédia';
        $product['length'] = '1:38:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Rrr.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Spider-Man';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Nesmělý, brýlatý Peter Parker je spíš inteligentní než mrštný a silný, spíš outsider, než hvězda třídy. Po smrti rodičů žije u tetičky May a strýce Bena. Tajně miluje spolužačku Mary Jane a jeho jediným kamarádem je Harry, syn bohatého Normana Osborna. Jeho osud změní školní exkurze v laboratořích Kolumbijské univerzity, kde ho kousne geneticky upravený pavouk. Získá nadlidskou sílu, zlepší se mu zrak, má bleskové reakce a dokáže předvídat hrozící nebezpečí.';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Spider-Man';
        $product['volume'] = 1;
        $product['author'] = 'Sam Reimi';
        $product['genre'] = 'akčný';
        $product['length'] = '2:01:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'SpiderMan1.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Spider-Man 2';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Tobey Maguire je tu opět coby Spider-Man, který jako jediný může zachránit New York. Skvělý fyzik, dr. Otto Octavius (Alfred molina), se nešťastnou náhodou promění v zuřivé, osmiramenné monstrum, Doc Ocka. Superinteligentní robot s chapadly na jeho zádech ovládá jeho mysl a nic nemůže zastavit práci na silném elektrickém zdroji. Město volá svého hrdinu na pomoc, ale Spidey nikde není!';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Spider-Man';
        $product['volume'] = 2;
        $product['author'] = 'Sam Reimi';
        $product['genre'] = 'akčný';
        $product['length'] = '2:07:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'SpiderMan2.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Úžasňákovi';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Bob Parr, známý jako Mr. Úžasný, býval jedním z největších světových superhrdinů a zachraňování světa bylo jeho denním chlebem. Svůj superoblek musel pověsit na hřebík před patnácti lety. Dnes pracuje jako odhadce škod pro pojišťovnu a bojuje s nudou a rostoucím břichem. Se svou manželkou (bývalou Elastiženou) a třemi dětmi se pokoušejí žít normální život. Jeho chvíle ale přijde, když ho tajemný kontakt vyšle na vzdálený ostrov s tajným posláním. Tam zjistí, že génius zla připravuje ďábelskou pomstu světu...';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Úžasňákovi';
        $product['volume'] = 1;
        $product['author'] = 'Brad Bird';
        $product['genre'] = 'animovaný';
        $product['length'] = '1:55:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Uzasnakovi.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Vetřelec';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Vesmírná loď Nostromo míří zpět na Zemi, astronauti spí. Náhle dojde k jejich automatickému probuzení – nikdo neví, co se děje, protože jsou ještě velmi daleko od cíle cesty. Prostřednictvím centrálního počítače zjistí, že přijímače zachytily signál SOS z blízké planety. Posádka je povinna věc vyšetřit. Vyslaný modul má s přistáním velké problémy. Přesto někteří na průzkum. V jeskynním komplexu objeví podivný organizmus, který vypadá jako kolonie vajíček.';
        $product['rating'] = 4.5;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['series'] = 'Vetřelec';
        $product['volume'] = 1;
        $product['author'] = 'Ridley Scott';
        $product['genre'] = 'horor';
        $product['length'] = '1:57:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'Vetrelec.jpg';
        $image['product_id'] = $product['id'];
        $image['number'] = 1;
        $image->save();

        $product = new Product;
        $product['title'] = 'Zachraňte vojína Ryana';
        $product['price'] = 9.99;
        $product['quantity'] = 70;
        $product['description'] = 'Hrůzy války velkolepým způsobem ožívají ve skvělém válečném dramatu Stevena Spielberga. Snímek začíná invazí spojeneckých vojsk na pláži v Normandii, k níž došlo 6. června roku 1944. Kapitán Miller (Tom Hanks) a členové druhého praporu Rangers se snaží zajistit předmostí pláže. Během invaze jsou zabiti dva bratři. Třetí už dříve padl v boji v Nové Guineji. Jejich matka, paní Ryanová, má obdržet všechna tři úmrtní oznámení v jeden den. Náčelník generálního štábu armády Spojených států George C. Marshall dostane příležitost alespoň trochu zmírnit její zármutek poté, co zjistí, že existuje ještě čtvrtý bratr, vojín James Ryan, který zmizel kdesi ve Francii. Osmičlenný oddíl kapitána Millera dostane rozkaz najít vojína Ryana a přivést ho zpátky k jeho matce.';
        $product['rating'] = 5.0;
        $product['language'] = 'český';
        $product['type'] = 'film';
        $product['author'] = 'Steven Spielberg';
        $product['genre'] = 'vojnový';
        $product['length'] = '2:43:00';
        $product->save();

        $image = new Image;
        $image['image'] = 'VojinRyan.jpg';
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
