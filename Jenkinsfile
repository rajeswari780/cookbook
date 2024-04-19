pipeline {
    agent any
    stages {
        // stage('Checkout') {
        //     steps {
        //         git 'https://github.com/rajeswari780/cookbook.git'
        //     }
        // }
        stage('Deploy') {
            steps {
                sh 'wget -r -np -nH --cut-dirs=1 http://35.231.56.15/var/www/html/drupal/'
                sh 'cp -r https://github.com/rajeswari780/cookbook.git/* /var/www/html/drupal/'
            }
        }
    }
}
