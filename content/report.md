---
title: "Report"
class: "report"
...
Report
=========================

##### kmom01 #####

---------------------------------------

###### Gör din egen kunskapsinventering baserat på PHP The Right Way, berätta om dina styrkor och svagheter som du vill förstärka under det kommande året.

Jag har läst igenom hela PHP The Right Way sidan och det verkar som att jag har väldigt mycket att lära mig. Jag kunde fatta vad alla begrepp innebär, det kvarstående är att faktiskt öva på alla dessa saker som jag har aldrig gjort, vilket inte är lätt. Jag har absolut ingen erfarenhet i testing i PHP, eller jo, det hade vi gjort lite, men det går inte att säga att jag kan tester om jag har gjort bara en enda enhetstest, som inte var bra. Dessutom så märkte jag att koden jag producerade i oophp kursen var uppenbarligen icke testbar, så nej, jag vet ingenting om tester.

Design patterns har jag aldrig gjort också. Jag vet vad det är men jag har aldrig en möjlighet att faktiskt implementera de själv i php.  Aldrig gjort localisation eller virtualisation. Har bara hört talats om CI och aldrig gjort det. Automatiserade tester låter som en gåta för mig.
Det är mycket att göra!

###### Vilket blev resultatet från din mini-undersökning om vilka ramverk som för närvarande är mest populära inom PHP (ange källa var du fann informationen)?

Det verkar som att att Laravel är fortfarande det mest populära ramverket inom php världen från år 2014 då Mos gjorde sin undersökning.

<figure class="figure">
  <img src="https://coderseye.com/wp-content/uploads/google-trends-best-php-frameworks-comparison.png" class="figure-img img-fluid rounded" alt="graph">
  <figcaption class="figure-caption" markdown="1">
  [Källan](https://coderseye.com/best-php-frameworks-for-web-developers/)
  </figcaption>
</figure>

År 2014 hade alla stora ramverk ungefär samma antal sökningar. Det intressanta är att Laravel kom upp i populäritet ganska snabbt, det ser man på det stigande kurvan. Det visade sig till slut att det är det mest populära ramverket nuförtiden.

En annan intressant sak är att alla dessa kurvor går ner väldigt snabbt i slutet av grafen. Vad kan det betyda? Kan det vara så att php håller på och dö? Det får vi se. Det kan ha en anknytning till att folk börjar flytta till Python för att driva webben.

###### Berätta om din syn/erfarenhet generellt kring communities och specifikt communities inom opensource och programmeringsdomänen.

Jag tycker att varje community är en positiv sak oberoende på vad den handlar om. Att man delar sina kunskaper med andra gör att folk lär sig snabbare, vilket leder till en snabbare utveckling. I tekniskt sammanhang betyder det att folk blir bättre på vad de gör, detta gör att produkten som programmerare producerar får högre kvalitetsnivå. Är inte det trevligt?

Dessutom så skapas det mycket i sådana communities. Folk kommer upp med nya lösningar som förbättrar vardagen, helt enkelt. Skulle det inte finnas communities i programmering då skulle vi inte ha så mycket information och mjukvara som finns nuförtiden.
Varje individ kan välja bland massa av olika tekniker som passar bäst till det man håller på.

Jag har aldrig varit med i någon programmeringscommunity om man inte räknar med dbwebb. Personligt så tycker jag att det är väldigt givande att dela med sig och lyssna eller läsa på vad folk berättar. Detta hjälper att skapa både förståelse och intresse.

###### Vad tror du om begreppet “en ramverkslös värld” som framfördes i videon?

Jag tycker att det precis det som programmering i sig har alltid strävat efter. Från början ville man dela på koden, göra så att den blir modulär och återanvändbar. OOP handlar mycket om detta. Det finns massa problem med detta, det största är att bestämma hur exakt bygger man sådana system som är så att säga utbytbara. Det är därför man har till exempel PHP-FIG, en organisation som försöker att standardisera allt inom phpvärlden.

Jag håller med idén att man bör ta ett steg ifrån limma mellan olika delar av ramverket och sträva efter mer frihet. Just nu så pågår exakt detta inte para i php världen, men också i frontend. Facebook hade kommit upp med sin React, till exempel.

###### Hur gick dina förberedelser inför kommentarssystemet?

Jag tycker att det bästa sättet att komma igång med en sådant system är att modulera en databas. Så jag ser det som så:

1. Det finns ett tema, tråd eller vad är det nu är, som äger sina kommentarer.
2. Kommentarerna är kopplade till temat och ligger i en tabell, det blir one-to-many relation. En kommentar kan ha ett tema, tema har många kommentarer.
3. Kommentar kan ha många underkommentarer som också ligger i en separat tabell. Nu tänker jag på det viset som Stackoverflow fungerar.
4. I kommentartabellen ligger det användarnamn, datum för när det läggs in, raderingsdatum, uppdateringsdatum, tillsammans med dess text.
5. Underkommentar är kopplat till sin förälderkommentar.

Det jag kan återanvända är loginsystemet och databasmodulen, dock så ska jag bearbera koden igen så att det blir inga bekymmer och för att få tillfredsställelsen.

##### kmom02 #####

---------------------------------------

###### Vilka tidigare erfarenheter har du av MVC? Använde du någon speciell källa för att läsa på om MVC? Kan du med egna ord förklara någon fördel med kontroller/modell-begreppet, så som du ser på det?

Jag har använt flask i samband med oopython kursen, annars så har jag inte erfarenheter som inblandar designmönster.
För att läsa mer om MVC arkitektur så använde jag de källor som fanns med i kmom. Det var väldigt spännande att titta på konferenser tycker jag. De ger en överblick av världen omkring, och det är ofta folk som är värda att lyssna på.
Om man delar kod i en kontroller och modell som implementerar funktionaliteten då kan man byta ut modellen man använder eller dela den med andra. Detta bidrar till det som kallar en ramverkslös värld och OOP generellt. Det finns ett lager som utför arbete, och den ska ju utföra bara det den ska, inte mer eller mindre. Kontrollern behandlar request, modellen lyfter vikt liksom.

###### Kom du fram till vad begreppet SOLID innebar och vilka källor använde du? Kan du förklara SOLID på ett par rader med dina egna ord?

SOLID är en akronym som kom fram i slutet av nittitalet och har att göra först och främst med OOP. Den formulerar ett tankesätt som en programmerare ska hålla sig till om den skapar OOP kod. Det känns lite flummigt och oklart, men jag tror att det kommer lösas med tiden.

S står för Single responsability, och det innebär att varje klass ska göra en enda sak.
O står för Open Closed principle vilket innebär att program ska vara stängda för modifikation men tillåta extension, precis som vi gör med anax moduler.
L är Liskov substitution principle. Den säger att objekt i programmet ska vara utbytbara mot sina subtyper utan att något i programmet går fel.
I står för interface segregation. Den säger att interfaces ska vara så specifika som möjligt.
D står för dependency inversion. Tanken är att beroenden ska vara en abstraktion, inte något konkret.

###### Gick arbetet med REM servern bra och du lyckades integrera den i din me-sida?

Det var väldigt enkelt, inga konstigheter. Artikeln var väldigt bra, som vanligt. Dessutom så fick vi ett exempel på hur strukturerar man koden.

###### Berätta om arbetet med din kommentarsmodul, hur långt har du kommit och hur tänker du?

Jag har valt att ta databasvägen direkt, så jag sparar inget i cookies för att jag känner att det är fel, dessutom så får jag inte göra om det sedan. Så jag kör som vanligt, anax db modulen, MySQL databas. Just nu så är det bara en tabell med allt som behövs, men det kommer ju att bli lite med avancerat med tiden.
Just nu så har jag ett fungerande kommentarsystem som är kopplat till bluray. Jag har lyckats att strukturera kod enligt anvisningarna i en kontroller och modell, det kändes trevligt att göra det. Saker faller på sin platts nu och jag får mer uppfattning om anax arkitektur i helhet.

##### kmom03 #####

---------------------------------------

###### Hur känns det att jobba med begreppen kring dependency injection, service locator och lazy loading?

Jag hade väldigt få problem med implementationen, allt föll på sin plats. Det är smidigt att använda dependency injection och lazy loadnig, det känns trevligt när man vet att man använder best practices. Men rent kodmässigt blev det find och replace för mig.

###### Hur känns det att göra dig av med beroendet till $app, blir $id bättre?

Rent användarmässigt känns det lite obekvämt, först måste man lägga till alla tjänster som sta användas I variabler innan man faktiskt använder de. Det blir mer kodrader, vilket känns lite konstigt. Men annars så har jag absolut inga problem med detta, jag använder inte app där den inte ska användas.

###### Hur känns det att återigen göra refaktoring på din me-sida, blir det förbättringar på kodstrukturen, eller bara annorlunda?

Det känns som att det blir bara annorlunda, jag tror inte att man inte kan få en känsla av det man gör I en sån liten projekt som vi har. Sedan oopython kursen så var jag van med utseende på routern som vi hade då. Det kändes lite konstigt att bygga om till det vi fick. Det blev bara svårare att fatta för min del. På den andra sidan så vet jag att vi använder de bästa praktiken. Hoppas på att jag kommer att faktiskt få en känsla av varför det ska vara på det sättet som det är. Det är svårt att förstå fördelar med en sådan upplägg om man aldrig har haft behov av en liknande struktur. Men rent teoretiskt så fattar jag varför det är som det är.

###### Lyckades du införa begreppen kring DI när du vidareutvecklade ditt kommentarssystem?

Oja, absolut. Det var väldigt få ändringar för mig, det gick smärtfritt om man inte räknar med problemet att min data variabeln som jag skickade till vyn inte funkade. Men det löste sig.
Påbörjade du arbetet (hur gick det) med databasmodellen eller avvaktar du till kommande kmom?

Jag valde att avvakta för att jag redan har en databas och vill inte göra om så mycket I nästa kmom. Jag kommer att ta det steg för steg. Jag vill börja med active record direkt. Tycker att det blir mer optimalt.

Allmänna kommentare kring din me-sida och dess kodstruktur?


Nu blev det mer MVC likt tycker jag. Det finns platser där $app fortfarande används, Routern är helt ombyggd, så jag använder aldrig app, om jag inte missar något. Jag saknar lite docblockkommentarer, men det är lugnt såhär långt tycker jag. Annars så försöker jag mitt bästa att använda allting anax erbjuder, till exempel regioner. Har också fått bort html ifrån md filer. Så det blev bra, tycker jag.


##### kmom04 #####

---------------------------------------

###### Till dig som rättar

doe@doe.doe | doe – användare

admin@admin.admin | admin – administratör


###### Hur gick det att integrera formulärhantering och databashantering i ditt kommentarssystem?

Det var massa nya saker såsom query builder och Active record design pattern, dessutom så fick vi jobba med HTMLForm. Det tog ett tag för mig för att övertyga mig själv att detta är ett bra sätt att jobba på och att faktiskt fatta hur jobbar man med det nya kodbas. Men jag harlyckats till slut. Dock så har jag några funderingar kring detta. Jag tycker att formulärhantering i sin nuvarande form är lite lurig. Jag fick flytta koden som har med databas att göra till Form’s callback, detta verkar vara lite fel. Det kändes som att detta var modellens ansvar. Jag har inte kommit på något bättre sätt att göra det på. Men annars så gick det bra, det handlade mycket om att läsa Mikaels kod och docstrings innan man faktiskt fattar.

###### Berätta om din syn på Active record och liknande upplägg, ser du fördelar och nackdelar?


Ju, det är ganska smidigt att jobba på det sättet. Det är alltid trevligt med en sådan ORM liknande när man får möjligheten att jobba i samma miljö man är van vid. Man kan abstrahera bort MySQL delen. Dock så kan det dyka upp svårigheter om APIet eller föräldrar klasser inte erbjuder det funktionalitet som behövs.

###### Utveckla din syn på koden du nu har i ramverket och din kommentars- och användarkod. Hur känns det?


Jag har gått igenom ett tal svårigheter, så att kod kvalitén ökade desto längre fram i uppgiften jag kom och desto mer jag fattade om dessa nya verktygen vi fick jobba med. Så jag har ganska varierande kvalité på koden nu. Men annars så känns det bra att jobba med abstraktioner och bara peka på de metoder som utför nästan allt arbete. Det är smidigt att jobba på det sättet om man vet hur man jobbar det Active record, query builder och HTMLForm. Det enda saken jag skulle dissa (säkert för att jag inte vet hur man gör det rätt) är att modellkoden flyttades till formulärens callback.

###### Om du vill, och har kunskap om, kan du även berätta om din syn på ORM och designmönstret Data Mapper som är närbesläktade med Active Record. Du kanske har erfarenhet av likande upplägg i andra sammanhang?


Det enda jag vet om ORM är det vi gick igenom i oopython kursen, jag har jobbat ganska mycket med SQLAlchemy, och jag faktiskt gillade det. Dock så har jag glömt hur man jobbade med sådant upplägg så att jag har inte så mycket att säga om det.

###### Vad tror du om begreppet scaffolding, kan det vara något att kika mer på?

Oja, jag tycker att det är väldigt bra att ha i sitt lilla projekt. Det gör det smidigt att få fram en struktur som kan testar direkt. Scaffolding hjälper till att få färre felkällor och sparar tid, det är ju alltid bra att ha.


##### kmom05 #####

---------------------------------------

###### Hur gick arbetet med att lyfta ut koden ur me-sidan och placera i en egen modul?


Det gick nästan smärtfritt. Det krånglade med modulnamnet i början, och det var för att jag inte ändrade i den scaffoldade composer.json filen. Det var ett par små bekymmer men gick utan problem annars. Det blev inte så modulärt som jag ville ha det men jag valde att hålla det enkelt och endast skapa en enda modul som innehåller nästan all min kod. Så det blev en klump, ja.

###### Flöt det på bra med GitHub och kopplingen till Packagist?


Det gick absolut utan problem. Det var väldigt tydligt förklarat i artikeln, så det tog typ 15 minuter att göra det. Det var enklare för mig att lösa uppgiften för att jag jobbar i Unix miljö, så allting blir lite enklare för mig.

###### Hur gick det att åter installera modulen i din me-sida med composer, kunde du följa du din installationsmanual?


Jag har testat min manual och den borde fungera bra. Observera att du inte kan köra tester om du inte dumpar in min databas. Dumpfilen ligger under sql mappen. För min anax så handlade det bara om att installera och så fungerade allting direkt.

###### Hur väl lyckas du enhetstesta din modul och hur mycket kodtäckning fick du med?


Jag har fått ungefär 10% kodtäckning. Jag lämnar denna delen till kmom06, annars så hinner jag inte att jobba med indproj. Men det blev lite googling och ett par frågor i chatten för mig. Problemet var att min lokala php installation hade inte PDO modulen med. Det tog lite tid innan jag fattade. Fick hjälp i chatten av Irc. Hade också problem med dsn strängen, fick ändra localhost till 127.0.0.1.

###### Några reflektioner över skillnaden med och utan modul?

Det är absolut ingen skillnad utifrån min anax installation. Allting ser likadant ut. Det blev mer fördelat och strukturen har blivit bättre. Nu ser jag möjligheten att fördela arbetet, man kan bara distribuera arbetet mellan olika medarbetare, varje av de kan nu jobba med sin egen lilla del, ha en egen repo, testa och så. På detta sättet det blev bättre. Dessutom så är det möjligt att hämta hem modulen med ett enda kommando.


##### kmom06 #####

---------------------------------------

###### Har du någon erfarenhet av automatiserade testar och CI sedan tidigare?

Nej, det har jag inte. Jag har alldrig hört talas om sådant.


###### Hur ser du på begreppen, bra, onödigt, nödvändigt, tidskrävande?

Är det ett stort projekt man jobbar i då är det väldigt bra att ha. Det underlättar för kommunikation i teamet och gör utvecklingsprocessen enklare och smidigare. Det är väldigt trevligt med statisk kodanalys, tycker jag. Gåt något åt skogen så ser man det direkt.


###### Hur stor kodtäckning lyckades du uppnå i din modul?

Jag har gått upp till 42% kodtäckning. Det var främst controllers som är svårtestade. Dels så var det för att min modul innehåller page render classer. Dessa har jag inte testat. Men Comment och User har ganska bra täckning, speciellt Comment.

###### Berätta hur det gick att integrera mot de olika externa tjänsterna?

Det gick rätt fort för mig. Det var bara att logga in med github, och så är det klart. Jag har börjat med CircleCI, men de använder inte php7, så jag hoppade över till TravisCI. Min badge för scrutinizer code coverage visas inte rätt på github repot, men om man klickar på den så ser man det av någon anledning. Cache problem borde det vara.


###### Vilken extern tjänst uppskattade du mest, eller har du förslag på ytterligare externa tjänster att använda?

Scrutinizer. Det är säkert en vinnare över de andra för att den har statisk kodanalys inte bara i form av phpcs och phpmd.
