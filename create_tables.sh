#!/bin/bash

source config/environment.sh

echo "Luodaan tietokantataulut..."

ssh samuvait@users.cs.helsinki.fi "
cd htdocs/tsohasov/sql
cat drop_tables.sql create_tables.sql | psql -1 -f -
exit"

echo "Valmis!"
