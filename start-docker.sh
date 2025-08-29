#!/bin/bash

echo "========================================"
echo "   Bayt Al-Kitab - Docker Launcher"
echo "========================================"
echo

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "ERROR: Docker is not installed!"
    echo "Please install Docker and start it."
    exit 1
fi

# Check if Docker is running
if ! docker info &> /dev/null; then
    echo "ERROR: Docker is not running!"
    echo "Please start Docker Desktop or Docker daemon."
    exit 1
fi

echo "Docker is available!"
echo

echo "Starting Bayt Al-Kitab..."
docker-compose up -d

if [ $? -ne 0 ]; then
    echo "ERROR: Failed to start containers!"
    exit 1
fi

echo
echo "========================================"
echo "   Application started successfully!"
echo "========================================"
echo
echo "Site public: http://localhost:8080"
echo "Administration: http://localhost:8080/admin"
echo
echo "Admin credentials:"
echo "Email: admin@bayt.com"
echo "Password: admin1234"
echo
echo "To stop the application, run: docker-compose down"
echo "To view logs, run: docker-compose logs -f"
echo 