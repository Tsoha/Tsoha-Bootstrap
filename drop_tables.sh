#!/bin/bash

source config/environment.sh

echo "Poistetaan tietokantataulut..."

ssh samuvait@users.cs.helsinki.fi "
cd htdocs/tsohasov/sql
psql < drop_tables.sql
exit"

echo "Valmis!"
