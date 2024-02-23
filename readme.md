data.db
savedparameters.db

Są to bazy danych typu klucz-wartość. Baza data.db przechodwuje dane do logowania użytkowników. Hasła są przechowywane zahashowane z pomocą domyślnego algorytmu PHP (na chwilę obecną bcrypt).
Baza savedparameters przechowuje parametry do animacji konkretnego użytkownika.

style.css

Plik zawierający styl wszystkich stron.

drawingscript.js 

Jest to kod w javascripcie odpowiedzialny za obsługę animacji oraz ustawiania konkretnych parametrów animacji.

userpanel.php

Strona dostępna tylko dla zalogowanych użytkowników. Pozwala podejrzeć ustawione parametry i dodać nowe w przypadku braku parametrów lub edytować obecne. Aby otworzyć formularz edycji należy nacisnąć odpowiedni przycisk na stronie.

logout.php

Funckja wylogowująca.

login.php

Formularz rejestracji i logowania. Nie można zarejestrować dwóch użytkowników o takiej samej nazwie użytkownika.

index.php

Strona główna, zawiera treść merytoryczną, animacje (dla zalogowanego użytkownika istnieje opcja załadowania własnych parametrów).