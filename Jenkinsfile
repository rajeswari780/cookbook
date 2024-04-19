pipeline {
    agent any

    stages {
        // stage('Fetch Code') {
        //     steps {
        //         // Fetch the code from your Git repository
        //         git branch: 'main', url: 'https://github.com/rajeswari780/cookbook.git'
        //     }
        // }
        stage('Deploy Changes') {
            steps {
                // Copy the updated files to the GCP compute engine instance using rsync
                sh 'scp -r C:/Users/admin/.jenkins/workspace/drupal_project/modules/ root@35.231.56.15:/var/www/html/drupal/modules'
            }
        }
    }
}

