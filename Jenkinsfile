
  echo "Switching to project docroot."
  cd /var/www/html/drupal/
  echo ""
  echo "Pulling down the latest code."
  git pull origin main
  echo ""
  echo "Clearing drush caches."
  drush cr
  echo ""
  echo "Running database updates."
  drush updb -y
  echo ""
  echo "Importing configuration."
  drush config:import -y
  echo ""
  echo "Clearing caches."
  drush cr
  echo ""
  echo "Deployment complete."