# CREATE-FILE-JSON(Beta 0.5)

facilita a criação de arquivos json.
Inicialmente criado para utilizar junto com a biblioteca de [Tradução](#)

Obs. Não implementado a criação de json de sub chaves dentro da sub Chaves ex: 
"usuario": {
    "nome": "teste",
    "endereco: {
        "rua": "teste de rua"
    }
  }'


## INSTRUÇÕES
A duas formas de gerar o Json 

Forma 1: 

![alt text](https://github.com/Matheus-Perez/create-file-json/blob/master/assets/dist/images/exemple_one.jpg)

Criar um arquivo csv igual a do exemplo 1, somente 2 colunas uma para o nome da chave e outra para o valor da chave, não se esqueça de que quado for criar uma sub chave tem que abrir e fechar a chave '{}' 

Forma 2: 

![alt text](https://github.com/Matheus-Perez/create-file-json/blob/master/assets/dist/images/exemple_two.jpg)
Na forma dois ele vai gerar pastas separadas para cada coluna criada, nessa forma a primeira linha do seu arquivo deve ser para o nome das pastas, sempre deixando a primeira coluna para o nome das keys como mostrado no exemplo 2

essa Forma foi criada para ser utilizado junto com a biblioteca de [Tradução](#)

Na raiz do projeto existe os dois arquivos cvs citados no texto acima.

## Construído com

* [PHP 5.6](http://php.net)
* [Bootstrap](https://getbootstrap.com/)


## Autores

* **Matheus Perez** - *Projeto inicial* - [Perez](https://github.com/Matheus-Perez)
