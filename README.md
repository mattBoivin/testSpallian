# Technical test Boivin

## Affichage

Minimaliste.
-> fichiers css externes.
-> utilisation éventuelle d'un outil comme bootstrap

## HTTP

Seul DELETE répond aux normes de verbes HTTP.
Étant très habitué aux API REST, ce n'est pas très naturel pour moi d'utiliser la même fonction pour faire un affichage et un POST de formulaire

## Sécurité

Contrôle utilisateur authentifié, puis contrôle par requête SQL dans le repository pour les endPoints unitaires.
-> On peut peut-être faire mieux en ajoutant un resolver

Log

Pas de log en place

Exception

Pas de gestion d'exception spécifique