# Simple PHP app

This is a simple PHP application running in a Kubernetes pod. It uses Nginx as the web server and PHP-FPM for processing PHP scripts.


## Prerequisites
* kubectl
* minikube

## Deployment
1. `minikube start --nodes=1`
1. `eval $(minikube docker-env)` *
1. `docker build -t simpleapp .`
1. `kubectl apply -f configmap.yaml`
1. `kubectl apply -f pod.yaml`
1. `kubectl port-forward pod/my-web-app 8000:80`
1. Open your browser and go to `http://localhost:8000` to see the application running.

\* *Note: The `eval $(minikube docker-env)` command is used to set the Docker environment variables so that the Docker CLI can communicate with the Minikube Docker daemon. To verify your terminal is using minikube’s docker-env you can check the value of the environment variable MINIKUBE_ACTIVE_DOCKERD to reflect the cluster name. (`printenv MINIKUBE_ACTIVE_DOCKERD`).*