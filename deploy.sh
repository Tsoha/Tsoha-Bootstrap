#!/bin/bash

# Missä kansiossa komento suoritetaan
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

source $DIR/config/environment.sh

echo "Siirretään tiedostot users-palvelimelle..."

# Tämä komento siirtää tiedostot palvelimelta
rsync -z -r $DIR/app $DIR/assets $DIR/config $DIR/lib $DIR/sql $DIR/vendor $DIR/index.php $DIR/composer.json samuvait@users.cs.helsinki.fi:htdocs/tsohasov

echo "Valmis!"

echo "Suoritetaan komento php composer.phar dump-autoload..."

# Suoritetaan php composer.phar dump-autoload
ssh samuvait@users.cs.helsinki.fi "
cd htdocs/tsohasov
php composer.phar dump-autoload
exit"

echo "Valmis! Sovelluksesi on nyt valmiina osoitteessa $USERNAME.users.cs.helsinki.fi/$PROJECT_FOLDER"
