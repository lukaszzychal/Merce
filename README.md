# Merce
Merce Task

[ Uzasadnienie podjętych decyzji projektowych ]

1. Użyte bibloteki:
    * Docker w celu szybkiego uruchomienia środowiska
    * Composer do instalacji biblotek, zarządzania przestrzenią nazw psr-4 oraz pisania skryptów przyspiesających prace
    * PHPUnit do testów
    * php-cs-fixer podpięty pod pre-comit w celu utrzymania porządku kodu bez potrzeby ciągłego pilnowania i skupieniu się na aplikacji - jeśli czas komitów będzie zbyt długi to wyłącze
    * psr/http-message - interfacy oficjalne php-fig psr7
    * psr/http-client  - interfacy oficjalne php-fig psr18
    * psr/http-factory - interface oficjalny potrzebnych fabryk
    * nyholm/psr7 - implementacja psr-7 zgodnie z zadaniem miałem z korzystać z gotowej bibloteki

2. Repositorium:
    * Branch: Master (tagi 0.*.0), [features (tagi 0.0.*) ]
    * Merge z --squash
    * Branch-e nie usuwam do podglądów
    * Forma komitów do Mastera: type(opcjonalnie kontekst): podsumowanie
    * Forma komitów w brancha: Staranie się utrzymania formy type(opcjonalnie kontekst): podsumowanie, ale możliwe inne z wiązku, że coomity i tak gubię przy squashu
3. Sposób testowania i projektowania
    * Testy zaczynam od góry czyli od testów Aplikacji ponieważ mam największą więdzie o przypadkach użycia z zadania.
    * Będę się starał testowaćz wykorzystaniem TDD zaczynając od testów Aplikacji ogólnych, granicznych, podstawowych przypadków użycia zgodnie z zadaniem. Nowe przypadki użycia dodawane jako roszerzenie podstawowych przypadkó użycia. Wraz z wzrostem testwów  testy rodzielane na osobne, poszczególne pliki.
    * Po napisaniu przypadkach użycia  clienta , testy implementacji clienta z użyciem unit testów i testów integracyjnych.
    * Unit testy - tam gdzie jest możliwe i nie będzie potrzeby zbędnej implementacji będe używał fake objectów, pownieważ jest to prawdziwy obiek implementujący interfacy ( Uważam, że są to bardziej wiarygodne testy interfaców i obiektów)
4. Wnioski i napotkane problemy
    * Biblotekę zewnętrzą obudowałem adapterem fabryki. Chcicałem użyskać przez to pewną separację i odzielenie zewnętrznych zależności. Dzięki temu gdybym chiał zmienić biblotekę zewnętrzną robię to w jednym miejscu, a HttpCLient nie ma bezpośrednie powiązania z blibloteką. Sam client używa adaptera fabryki by dostać się do fabryk z zewnetrzej biblotek. Teraz trochę uważam, że przekobinowałem (choć swoją funkcje spełnia) i że to było nadmiarowe na potrzeby tego zadania.
    * Testy jednostkowe starałem się używać głównie do testowania wewnętrznego zachowania kodu oraz do testów gdzie można było użyć mocków, stubów lub utworzyć własny fake obiekt do sprawdzienia zależności
    * Testy integracyjne starałęm się u żywać do sprawdzenia poprawności wzajemniej relacji miedzy obiektami. 
    * Nie istotne dane w testach zaznaczałem jako nazwa zmiennej "any ..." oraz tam gdzie dało się  rónież jako tekst. Dzięki temu odrazu widać, że te dane nie pływają na test.
    * Dane istotne miały normalną nazwę abo bardziej precyzyjną. 
    * Tam gdzie mogłem starałem się używać danych z pliku danych testó ShareData by zapewnić spójność. 
    * Testy aplikacji zrobiłem tylko część. Użyłem publicznych endpointów https://dummyjson.com. (choć zewnętrze wywołania powinny być raczej hardcode/mock, a jedynie sprawdzać lokalne)
    * Trochę zajeło mi przypomnienie sobie działania PSR CLient,MEssage,Factoru,Stream.
    * Musiał sobie przypomnieć podstawy curl by się upewnić że testy aplikacji działają.
