pipeline {
    agent any

    stages {
        stage('Deploy Changes') {
            steps {
                // Copy the updated files to the GCP compute engine instance using rsync
                sh 'scp -r C:/Users/admin/.jenkins/workspace/drupal_project/modules/ rajimurugan1002@35.231.56.15:/var/www/html/drupal/modules'
            }
        }
    }
}

