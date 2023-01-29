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
    * Testowanie z wykorzystaniem TDD zaczynając od testów Aplikacji ogólnych, granicznych, podstawowych przypadków użycia zgodnie z zadaniem. Nowe przypadki użycia dodawane jako roszerzenie podstawowych przypadkó użycia. Wraz z wzrostem testwów  testy rodzielane na osobne, poszczególne pliki.
    * Po napisaniu przypadkach użycia  clienta , testy implementacji clienta z użyciem unit testó i testów integracyjnych.
    * Unit testy - tam gdzie jest możliwe i nie będzie potrzeby zbędnej implementacji będe używał fake objectów, pownieważ jest to prawdziwy obiek implementujący interfacy ( Uważam, zę są to bardziej wiarygodne testy interfaców i obiektów)
    
