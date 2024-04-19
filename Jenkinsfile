pipeline {
    agent any

    stages {
        stage('Copy to Remote Server') {
            steps {
                script {
                    // Define remote server details
                    def remoteServer = [
                        host: '35.231.56.15',
                        user: 'root',
                    ]

                    // Directory on the remote server where you want to copy the workspace
                    def remoteDir = '/var/www/html/drupal/'

                    // Directory in Jenkins workspace to copy
                    def localDir = 'drupal_project'

                    // Execute SCP command to copy files
                    sh "scp -r ${localDir} ${remoteServer.user}@${remoteServer.host}:${remoteDir}"

                    // If NGINX server is installed, you might want to restart it
                    // Example:
                    // sh "sshpass -p '${remoteServer.password}' ssh ${remoteServer.user}@${remoteServer.host} sudo service nginx restart"
                }
            }
        }
    }
}