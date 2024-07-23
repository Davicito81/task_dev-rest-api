# task_dev-rest-api

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo">
    </a>
</p>

<!--p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p -->

# Anleitung zur Einrichtung und Nutzung der Laravel REST-API

Diese Anleitung bietet eine schrittweise Erklärung zur Einrichtung und Nutzung der REST-API - zum Aufrufen und Bearbeiten von Produkten - in einer Docker-Umgebung. Sie ist für Anwender konzipiert, die die Anwendung zum ersten Mal aufsetzen.

## Voraussetzungen

Bevor Sie beginnen, stellen Sie sicher, dass folgende Software auf Ihrem System installiert ist:

- **Docker**: [Installieren von Docker](https://docs.docker.com/get-docker/)
- **Docker Compose** (wird normalerweise mit Docker Desktop auf Windows und Mac installiert):
  - Windows und Mac: Im Rahmen von Docker Desktop enthalten.
  - Linux: [Installieren von Docker Compose](https://docs.docker.com/compose/install/)

## Projekt herunterladen

1. **Klonen Sie das Repository**:
   Öffnen Sie ein Terminal oder eine Eingabeaufforderung und führen Sie folgenden Befehl aus:

   ```bash
   git clone https://github.com/Davicito81/task_dev-rest-api.git
   cd task_dev-rest-api
   ```
   Falls Git nicht installiert ist, können Sie das Projekt auch als ZIP-Datei direkt von GitHub herunterladen:

   Besuchen Sie https://github.com/Davicito81/task_dev-rest-api
   Klicken Sie auf Code und dann auf Download ZIP
   Entpacken Sie die ZIP-Datei und navigieren Sie in das Projektverzeichnis.
   
## Docker-Umgebung starten**

   Navigieren Sie im Terminal oder in der Eingabeaufforderung zum Projektverzeichnis und führen Sie folgenden Befehl aus:

   ```bash
   docker-compose up -d
   ```
   Dieser Befehl startet alle benötigten Dienste im Hintergrund.

## Datenbankmigrationen ausführen**: 
   Führen Sie die Migrationen aus, um die Datenbanktabellen zu initialisieren und die Standardprodukte in die Tabelle "products" zu migrieren:

   ```bash
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan db:seed --class=ProductsSeeder
   ```

## Nutzung der REST-API**:

   Übersicht aller möglichen Routen

   **Verfügbare API-Routen**

   | Method | URI                     | Name            | Action                                         |
   |--------|-------------------------|-----------------|------------------------------------------------|
   | GET    | /api/products           | products.index  | App\Http\Controllers\ProductController@index   |
   | POST   | /api/products           | products.store  | App\Http\Controllers\ProductController@store   |
   | GET    | /api/products/{product} | products.show   | App\Http\Controllers\ProductController@show    |
   | PUT    | /api/products/{product} | products.update | App\Http\Controllers\ProductController@update  |
   | DELETE | /api/products/{product} | products.destroy| App\Http\Controllers\ProductController@destroy |

   Diese Darstellung kann durch folgenden Docker Befehl abgerufen werden

   ```bash
   docker-compose exec app php artisan route:list   
   ``` 

   **Produkte ansehen**
   URL: localhost:9000/api/products
   Methode: GET

   **Produkt abfragen**
   URL: localhost:9000/api/products/{id}
   Methode: GET

   **Produkt hinzufügen**
   URL: localhost:9000/api/products
   Methode: POST
   Daten:
        ```json
        {
            "title": "[Titel des Produktes]",
            "description" => "[Beschreibung des Produktes]",
            "category" => "[Kethegorie des Produktes]",
            "state" => "[true|false]",   // das Attribute 'state' muss nicht zwingend angegeben werden.
        }        

   **Produkte hinzufügen**
   URL: localhost:9000/api/products/jsonList
   Methode: POST
   Daten:
        ```json
        [
            {
                "title": "[Titel des Produktes]",
                "description" => "[Beschreibung des Produktes]",
                "category" => "[Kethegorie des Produktes]",
                "state" => "[true|false]",   // das Attribute 'state' muss nicht zwingend angegeben werden.
            },
            {
                "title": "[Titel des Produktes]",
                "description" => "[Beschreibung des Produktes]",
                "category" => "[Kethegorie des Produktes]",
                "state" => "[true|false]",   // das Attribute 'state' muss nicht zwingend angegeben werden.
            },
            ...
        ]        

   **Produkt aktualisieren**
   URL: localhost:9000/api/products/{id}
   Methode: PUT
   Daten:
        ```json
        {
            "title": "[Titel des Produktes]",
            "description" => "[Beschreibung des Produktes]",
            "category" => "[Kethegorie des Produktes]",
            "state" => "[true|false]",   // das Attribute 'state' muss nicht zwingend angegeben werden.
        }        

   **Produkt aktualisieren**
   URL: localhost:9000/api/products/{id}
   Methode: DELETE

## Support**:
Bei Problemen oder Fragen zur Einrichtung oder Nutzung der API können Sie gerne ein Issue im GitHub-Repository erstellen oder den technischen Support kontaktieren.