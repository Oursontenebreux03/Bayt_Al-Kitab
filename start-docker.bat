@echo off
echo ========================================
echo    Bayt Al-Kitab - Docker Launcher
echo ========================================
echo.

echo Checking Docker...
docker --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Docker is not installed or not running!
    echo Please install Docker Desktop and start it.
    pause
    exit /b 1
)

echo Docker is available!
echo.

echo Starting Bayt Al-Kitab...
docker-compose up -d

if errorlevel 1 (
    echo ERROR: Failed to start containers!
    pause
    exit /b 1
)

echo.
echo ========================================
echo    Application started successfully!
echo ========================================
echo.
echo Site public: http://localhost:8080
echo Administration: http://localhost:8080/admin
echo.
echo Admin credentials:
echo Email: admin@bayt.com
echo Password: admin1234
echo.
echo To stop the application, run: docker-compose down
echo To view logs, run: docker-compose logs -f
echo.
pause 