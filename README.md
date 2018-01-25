# CREATE-FILE-JSON

facilita a criação de arquivos json 

Inicialmente criado para utilizar junto com a biblioteca de [Tradução](#)

Obs. Não implementado a criação de json com sub chaves ex: 
'"usuario": {
    "nome": "teste"
  }'


## INSTRUÇÕES

A utilização é bem simples, na raiz do arquivo está disponibilizado dois modelos de arquivos csv para serem utilizados.
Existe somente dois modelos:  

####Only one file
Nessa opção você deve usar um arquivo csv no mesmo padrão do arquivo de exemplo 'exemple_one_file.csv',
nesse arquivo somente tem 2 colunas a primeira coluna é a ‘chave’ e a segunda é o valor.
Depois de escolhido o arquivo e selecionado o modo é só clicar no botão 'gerar'
que ele vai te disponibilizar um botão para download do seu arquivo

####Translation structure
Nessa opção vc deve usar o arquivo csv no  mesmo padrão do arquivo de exemplo 'translate.csv', 
as duas primeiras linhas desse arquivo não devem ser mexidas 

linha 1 coluna 2: Nome do seu arquivo json 
Linha 2: nessa linha ficara os nomes das suas pastas a primeira coluna deve sempre ser deixada
sempre para as chaves
Linha 3 para baixo: aqui que ficaram a suas chaves e os valores de acordo com cada pasta

Linha de error: Depois que foi coloca essa linha abaixo dela só deve conter valores referente a 
erros

Pode adicionar quantas pastas quiser desde que a coluna de observações sege a última.

essa opção(Translation structure) foi criada para ser utilizado junto com a biblioteca de 
[Tradução](#)


## Construído com

* [PHP 5.6](http://php.net)
* [Bootstrap](https://getbootstrap.com/)


## Autores

* **Matheus Perez** - *Projeto inicial* - [PurpleBooth](https://github.com/Matheus-Perez)
