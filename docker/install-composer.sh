
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

# Calculate the SHA-384 hash of the downloaded installer
# SIG=$(php -r "hash_file('sha384', 'composer-setup.php');")

# # Download the expected SHA-384 hash from the official source
# EXP_SIG=$(wget -q -O - https://composer.github.io/installer.sig)

# if [ "$EXP_SIG" != "$SIG" ];
# then
#     echo 'ERROR: Invalid installer'
#     rm composer-setup.php
#     exit 1
# fi

# Install Composer
php composer-setup.php --quiet --install-dir=/usr/local/bin --filename=composer
RESULT=$?

# Clean up by removing the installer
php -r "unlink('composer-setup.php');"

# Exit with the result of the installation
exit $RESULT