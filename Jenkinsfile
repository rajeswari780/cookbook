pipeline {
    agent any
    
    environment {
        PROJECT_ID = 'networking-test-project-415703'
        INSTANCE_NAME = '35.231.56.15'
        ZONE = 'us-east1-b'
        GIT_REPO = 'https://github.com/rajeswari780/cookbook.git'
        DRUPAL_DIR = '/var/www/html/drupal/'
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: GIT_REPO
            }
        }

        stage('Deploy Code') {
            steps {
                sh "scp -r ${DRUPAL_DIR} rajimurugan1002@${INSTANCE_NAME}:${DRUPAL_DIR}"
            }
        }

        stage('Restart Apache') {
            steps {
                sh "ssh rajimurugan1002@${INSTANCE_NAME} sudo service nginx restart"
            }
        }
    }

    post {
        always {
            echo 'Deployment completed'
        }
    }
}
