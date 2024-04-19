pipeline {
    agent any
    
    stages {
        stage('Deploy Drupal') {
            steps {
                script {
                    // Set your instance IP address and other variables
                    def instanceIP = '35.231.56.15'
                    def sourceDir = 'C:/Users/admin/.jenkins/workspace/drupal_project/'
                    def destinationDir = '/var/www/html/drupal'
                    
                    // Copy Drupal code to the compute instance over HTTP
                    sh "curl -X POST -F 'file=@${sourceDir}/.' http://${instanceIP}/upload.php"
                }
            }
        }
    }
}
