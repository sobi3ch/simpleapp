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
1. `echo $(minikube ip):32111 | xclip -selection c`
1. In your browser paste (`ctrl-v`) and load the page

\* *NOTE: The `eval $(minikube docker-env)` command is used to set the Docker environment variables so that the Docker CLI can communicate with the Minikube Docker daemon. To verify your terminal is using minikube’s docker-env you can check the value of the environment variable MINIKUBE_ACTIVE_DOCKERD to reflect the cluster name. (`printenv MINIKUBE_ACTIVE_DOCKERD`).*

\* *NOTE 2: You can update your `/etc/hosts` file and add `minikube ip` to your custom local domain like `<YOUR-MINIKUBE-IP> minikube minikube.local` and then request site by the domain e.g.: `minikube:32111`*

\* *NOTE 3: For multi node (more then one) you need to use minikube  registry addon; For minikube 1.36 it will be this command to make the installation successful: `minikube addons enable registry --images="KubeRegistryProxy=registry.k8s.io/kube-registry-proxy:0.4,Registry=docker.io/registry:2.8.3"`*