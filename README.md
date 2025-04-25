# Instal·lacio

- Descarregat de Github
Crear un arxiu .env amb les dades necessàries, principalment la base de dades. 
Instal·lar/actualitzar les dependències de composer (composer install).
Còrrer les migracions per la base de dades (php artisan migrate).
Canviar el nom a l'arxiu Request.php.example a Request.php. 
Moure'l a vendor/nguyenary/qr-code-monkey/src/Request. Reemplaçar l'existent. RAÓ: la dependencia està modificada manualment *.
Servir l'aplicació (php artisan serve).

- A partir del .rar a Moodle
NO CAL CANVIAR EL ENV. Te totes les variables d'entorn necessàries.
NO CAL còrrer les migracions. Canviar la base de dades al .env si es volen còrrer les migracions **.
Instal·lar/actualitzar les dependències de composer (composer install).
Canviar el nom a l'arxiu Request.php.example a Request.php. 
Moure'l a vendor/nguyenary/qr-code-monkey/src/Request. Reemplaçar l'existent.
Servir l'aplicació (php artisan serve).

* És un workaround per permitir a laravel processar trucades a https des d'un servidor http, sense tenir certificat SSL.
** Si s'executen les migracions i la base de dades no està canviada al .env, es poden recrear de 0 les taules de la bbdd de producció. OJO CUIDADO!!! Xavi això va per tu.

- API
Per poder rebre informació de l'API, es requereix fer login a través de l'endpoint http://127.0.0.1:8000/api/login i obtenir el token. 
Endpoints:
    - /api/login (POST)
    - /api/users (GET) - només per usuaris administradors
    - /api/users/{id} (GET) - només per usuaris administradors
    - /api/pocions (GET) 
    - /api/pocions/{id} (GET) 

- Usuaris de proba
Usuari normal
User: Laravel
Contrasnya: Abcd1234

Usuari Admin
User: Admin
Contrasnya: Abcd1234