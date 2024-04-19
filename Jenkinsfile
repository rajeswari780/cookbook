pipeline {
    agent any

    stages {
        stage('Fetch Code') {
            steps {
                // Fetch the code from your Git repository
                git 'https://github.com/rajeswari780/cookbook.git'
            }
        }
        stage('Deploy Changes') {
            steps {
                // Copy the updated files to the GCP compute engine instance using rsync
                sh 'rsync -avz --delete --exclude=.git ./ rajimurugan1002@35.231.56.15:/var/www/html/'
            }
        }
    }
}

