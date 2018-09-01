---
...
Redovisning
=========================



Kmom01
-------------------------

###Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?
Det gick bra, genom att stega sig igenom [Kom i gång med PHP på 20 steg](https://dbwebb.se/kunskap/kom-i-gang-med-php-pa-20-steg)
väcktes lite av de objektorienterande kunskaperna jag inhämtat från kursen OOPython till liv. Den kursen är dock min sedan tidigare enda bekanskap med objektorienterad
programmering. Dock kände jag igen en del från den kursen som jag kunde relatera till.

###Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?
Jag har sedan kursen i HTMLPHP fortsatt att använda mig utav php som programmeringsspråk även utanför skolmiljön och har använt
get, post och session relativt kontinuerligt. Det nya inslaget var att använda sig av klasser. Då mycket(allt) av klassens struktur
fanns tillhanda tyckte jag att även den delen gick bra. [Guess my number](http://www.student.bth.se/~mahw17/dbwebb-kurser/oophp/me/kmom01/guess/index_get.php)

###Har du några inledande reflektioner kring me-sidan och dess struktur?
Förutom Design kursen har jag ingen erfarenhet av ramverket och jag upplever det som rätt komplext så här initialt.
Har försökt gå igenom de olika delarna men det finns många frågetecken kring funktionaliteten som jag hoppas kommer
klarna antingen i denna kursen eller i alla fall i kommande ramverks-kurser.

###Vilken är din TIL för detta kmom?
Måste väl erkänna att det vara mer "ja just det" upplevelser än "aha". Då mycket av det vi gjort
i detta kursmoment har vi berört i tidigare kurser så som klasser, git och ramverk.

Kmom02
-------------------------

###Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?
Det gick bra, jag följde Mikaels videos till punkt och pricka så det var inga problem.
La dock ingen egen länk i navbaren utan har lagt denna länk samt den till tärningsspelet under rubriken 'Spel/Lek'.
Jag fick anpassa min html-kod lite för att passa ramverkets stil.

[Gissa numret](gissa)

###Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?
Min första tanke var att jag skulle försöka komma på vilka klasser som behövdes och dess uppbyggnad innan jag började att koda.
Trots att jag börjar förstå konceptet med objekt tyckte jag att detta var svårt, det slutade med att jag började koda och skapade klasserna allt eftersom.
Börjar få koll på hur de olika delarna samverkar. View-delen är det som renderas på hemsidan, src/Dice/.. har jag mina klasser inom ett visst namespace och sedan
routern som är som en kontroller mellan klasserna och den som triggar renderingen av sidorna.

[Tärningsspelet](dice)

###Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor. Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?
Verkar ju klockrent! Om man kontinuerligt skapar bra kommentarer i sin kod som sedan kan läsas ut till en organiserad dokumentation ser jag inga nackdelar med detta.
Användningsområdet är ju självklart, att ska dokumentation över sin kod som man själv eller andra kan gå tillbaka till.

###Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?
Att jobba inom ett ramverk ger ju fördelarna av en redan färdig struktur som skall följas, du har även vissa designelement klara (navbar, footer).
Dessa fördelar kan även kanske var dess nackdel, ett ramverks struktur känns relativt komplex och om då den applikationen man vill skapa är relativt
enkel blir det trots detta mycket kod på grund av ramverkets struktur, du blir ju även till viss del låst till ramverkets design.


###Vilken är din TIL för detta kmom?
phpDocumentor var det som kändes mest nytt i detta kursmoment. Ska framöver försöka sätt mig in än mer i hur det fungerar och
hur mina kommentarer bör se ut för optimalt resultat.


Kmom03
-------------------------

###Har du tidigare erfarenheter av att skriva kod som testar annan kod?
I kursen OOPython-v2 var kursmoment 3 snarlikt denna veckans övning. I detta kursmoment
introducerades även det för mig nya begreppet radtäckning.

I övrigt har jag aldrig i förebyggande syfte skrivit kod för testning utan i så fall
har det varit i felsökningssyfte.

###Hur ser du på begreppen enhetstestning och att skriva testbar kod?
Antar att jobbar man i stora projeket måste varje liten del var testad/testbar och felsäkrad.
Känner redan att den kod jag själv skriver vill jag kapsla in och göra 'idiotsäker'. Dock blir
det tyvärr i slutänden inte så mycket av det på grund av lathet och tidsbrist.

###Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.
Med white box menas att man har tillgång till all källkod och det borde således göra att man kan kan utföra testfall som täcker
större delen av kodmängden. Med black box är det motsatsen, du ska testa ett gränsnitt/api och vet inte hur den bakomliggande koden ser ut. Grey tolkar jag
som ett mellanting mellan vit och svart, du ser eventuellt inte all källkod men kanske vilka funktioner/metoder som finns tillgängliga.

###Hur gick det att genomföra uppgifterna med enhetstester, använde du egna klasser som bas för din testning?
Tycker det har gått bra. Började med att göra testfall för Guess-klasserna i exempelmappen. Då detta gick bra kopierade jag över
mina egna Guess-klasser. Det svåra var inte att modifiera testfallen till att täcka mina egna klasser utan det som var lite
småknepigt var att få igång spelet och de nya testfallen. Tog en stund innan jag förstod att det krävdes en 'make install' för att uppdatera
autoloadern  att hitta de nya klasserna. Jag la tillslut även över min klasser från tärningsspelet som även dessa gick bra att validera.

###Vilken är din TIL för detta kmom?
Kodtäckning hade jag aldrig hört talas om innan och PHPunit skapade en fin och lättläst rapport över vilka tester som genomförts.

Kmom04
-------------------------

###Vilka är dina tankar och funderingar kring trait och interface?
Jag tolkar trait som en klass som ej 'klarar' sig själv, det vill säga att den är beroende av
att något annat. Detta något annat förtydligas med ett interface. Interfacet kräver att den som vill
använda trait:et även implementerar för trait:et nödvändinga metoder.

###Hur gick det att skapa intelligensen och taktiken till tärningsspelet, hur gjorde du?
Det gick bra att skapa i alla fall till en viss nivå lite intelligens hos datorn. Det som gjorde mig lite obekväm
var att min Game-klass börjar innehålla metoder som blir väldigt specialiserade och att klassen blir mer och mer
unik och svår att återvinna i andra applikationer.

Logiken/intelligensen skapade jag genom att först kontrollera poängdifferensen mellan spelaren och datorn.
Baserat på differensen blev datorn mer eller mindre riskbenägen, detta klassificerades i 7 steg mellan 0 - 85%.
Därefter beräknades sannolikheten för att nästa hand skulle innehålla slaget ett. Jag gjorde förenklingen
att varje tärning slogs för sig och efter varandra och beräknade således sannolikheten enligt (1-5/6^(antal tärningslag)) x 100.

Om sannolikheten för att nästkommande tärningshand skulle innehålla en etta är mindre än datorns riskbenägenhet väljer datorn att fortsätta.

###Några reflektioner från att integrera hårdare in i ramverkets klasser och struktur?
Tycker jag i princip hållt mig på samma nivå som i kursmoment 2 där vi integrerade 'Guess'-spelet. Så inget speciellt nytt
förutom att vi använt oss utav ramverkets variant av GET, POST och SESSION.

###Berätta hur väl du lyckades med make test inuti ramverket och hur väl du lyckades att testa din kod med enhetstester och vilken kodtäckning du fick.
Jag lyckades få igång enhetstestningen i ramverket och fokuserade på testen till min Game-klass som innehåller Tärningsspelet. En kodtäckning på 93.65% anser jag vara okej
då det är lite trixit att få till samtliga fall av riskbenägenhet.

###Vilken är din TIL för detta kmom?
Trait och Interface hade jag innan detta kursmoment aldrig tidigare hört talas om.


Kmom05
-------------------------

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
