## fotonotatnik-php-rest-api

Projekt wykonany przy użyciu PHP + Laraver framework

Wskazana zostanie implementacja kluczowa dla projektu, z pominięciem plików wygenerowanych przez narzędzia budujące i inne.

# /routers/api.php - kontroler obsługujący logowanie i rejestrację użytkowników

# /app - główna logika apikacji

Post.php - model / obiekt transferowy notatki
User.php - model / obiekt transferowy użytkownika

# ./HTTP - obsługa zapytań HTTP związanych z notatkami

*./Controllers/API* 

PostAPIController.php - obsługa tworzenia, zapisywania, edycji i usuwania notatki

#./Middleware - obsługa filtrów http

AuthBasic.php - Sprawdzenie nagłówka dla basic authentication

ponadto w *database/migrations* znajdują się pliki bazodanowe związane z tworzeniem przez nas tabel
