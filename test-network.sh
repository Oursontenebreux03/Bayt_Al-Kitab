#!/bin/bash

echo "🔍 Test de connectivité réseau..."
echo "================================"

echo "1. Test ping Google..."
ping -c 3 google.com

echo -e "\n2. Test ping Debian repos..."
ping -c 3 deb.debian.org

echo -e "\n3. Test DNS..."
nslookup deb.debian.org

echo -e "\n4. Test Docker..."
docker --version

echo -e "\n5. Test Docker daemon..."
docker info

echo -e "\n✅ Si tous les tests passent, relancer : docker-compose up -d"
