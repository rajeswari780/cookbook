pipeline{
    agent any
    environment{
        staging_server="35.231.56.15"
        remote_server = "C:/Users/admin/.jenkins/workspace/drupal_project/*"
    }

    stages{
        stage('Deploy to remote'){
            steps{
                sh 'scp -r ${remote_server}/* root@${staging_server}:/var/www/html/drupal/'
            }
        }
    }
}