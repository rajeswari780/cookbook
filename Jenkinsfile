pipeline{
    agent any
    environment{
        staging_server="35.231.56.15"
    }

    stages{
        stage('Deploy to remote'){
            steps{
                sh 'scp -r ${WORKSPACE}/* root@${staging_server}:/var/www/html/drupal/'
            }
        }
    }
}