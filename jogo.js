function shuffle(array) { //funcao de embaralhar as cartas
    var currentIndex = array.length, temporaryValue, randomIndex;
  
    while (0 !== currentIndex) {
  
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;
  
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }
  
    return array;
}

function Card(id, name){ //classe Card
    this.id = id;
    this.name = name;
    this.getId = function(){
        return this.id;
    };
    this.getName = function(){
        return this.name;
    };
    this.getInfo = function(){
        return this.id + this.name;
    };
}

document.getElementsByClassName("info")[0].style = 'display: none';  //retirando o nivel e pts da tela antes de começar o jogo
document.getElementsByClassName("info")[1].style = 'display: none';

var level;
var el2 = document.getElementById('body');
facil = 'facil';
medio = 'medio';
dificil = 'dificil';
listHtml = [
            '<button id="facil" class="btn-info" onclick="generateCards('+facil+')">Facil</button>', 
            '<button id="medio" class="btn-info" onclick="generateCards('+medio+')">Medio</button>',
            '<button id="dificil" class="btn-info" onclick="generateCards('+dificil+')">Dificil</button>',
            '<h1 id="levelSelect" class="jumbotron text-center">Selecione um nível: </h1>'];
for(content2 of listHtml){
    el2.insertAdjacentHTML('afterbegin', content2); //loop para inserir o codigo HTML que vai criar os botoes na tela
}

jaClicou = false;
function generateCards(dificuldade){
    if(!jaClicou){
        if(dificuldade == "facil"){
            qtdeCartas = 10;
        } else if(dificuldade == "medio"){
            qtdeCartas = 14;
        } else{
            qtdeCartas = 18;
        }
        document.getElementById("nivel").innerHTML = dificuldade; //escreve o nivel na tela
        level = dificuldade;
        jaClicou = true;
        var el = document.getElementById('body');
        var content;
        for(a = 0; a < qtdeCartas; a++){ //loop para criar as cartas na tela
            content = '<img class="hidden-card col-md-2 col-sm-4" src="images/hidden-card.png" id="'+a+'" onclick="checkMove('+a+')">';
            el.insertAdjacentHTML('afterbegin', content);
        }
        document.getElementById("levelSelect").style = 'display: none';
        document.getElementById("facil").style = 'display: none';
        document.getElementById("medio").style = 'display: none'; //tira a opção de esolher o nivel
        document.getElementById("dificil").style = 'display: none'; 

        document.getElementsByClassName("info")[0].style = 'display: show';  //recolocando o nivel e pts na tela
        document.getElementsByClassName("info")[1].style = 'display: show';  

        defineCards();
    }
}

function defineCards(){
    cards = ["images/queda-bastilha.png", "images/diretas-ja.png", "images/homem-lua.png",
    "images/steve-jobs.png", "images/hitler.png", "images/queda-bastilha.png", 
    "images/diretas-ja.png", "images/homem-lua.png",
    "images/steve-jobs.png", "images/hitler.png"];

    if(level == "facil"){
        //sem ação, todas as cartas ja estao na lista
    } else if(level == "medio"){
        for(a = 0; a < 2; a++){
            cards.push("images/torres-gemeas.jpg");
            cards.push("images/14bis.jpg");
        }
    } else{
        for(a = 0; a < 2; a++){
            cards.push("images/torres-gemeas.jpg");
            cards.push("images/14bis.jpg");
            cards.push("images/cafu-2002.jpg");
            cards.push("images/barack-obama.jpg");
        }
    }
    cards = shuffle(cards); //embaralhando as cartas

    for(a = 0; a < cards.length; a++){ //criando objetos card
        var card = new Card(a, cards[a]);
        cardsObject.push(card);
    }
}

cardsObject = [];
userPoints = 0;
clicks = 0;
selectedCards = [];

function revealCard(num){
    selectedCard = findCard(num);
    document.getElementById(num).src = selectedCard.getName();
    selectedCards.push(selectedCard);
}

function checkMove(num){
    jogadaValida = true;
    if(clicks < 2){
        clicks++;
        revealCard(num);

        if(clicks == 2){
            if(selectedCards[0].getName() == selectedCards[1].getName() &&
                selectedCards[0].getId() == selectedCards[1].getId()){ //se forem cartas iguais, mas for a mesma carta

                clicks--; //volta um click, jogada inválida
                selectedCards.pop(); //retira a ultima carta selecionada, jogada inválida 
                alert("Não pode clicar na mesma carta");   
                jogadaValida = false; //invalida a jogada
            }

            if(jogadaValida){
                setTimeout(checkPair, 2000)
            }
            
        }
        
    }
}

function checkPair(){
    if(selectedCards[0].getName() == selectedCards[1].getName() &&
       selectedCards[0].getId() != selectedCards[1].getId()){ //se forem cartas iguais, e nao for a mesma carta

        document.getElementById(selectedCards[0].getId()).src = "";  //retira a carta da tela
        document.getElementById(selectedCards[1].getId()).src = ""; 
        userPoints++;
        document.getElementById("pontos").innerHTML = userPoints;
        openModal();
    } else{
        document.getElementById(selectedCards[0].getId()).src = "images/hidden-card.png"; //vira a carta para baixo
        document.getElementById(selectedCards[1].getId()).src = "images/hidden-card.png"; 
    }
    
    clicks = 0; //resetando o numero de clicks
    selectedCards = []; //resetando a lista de cartas selecionadas
}

function findCard(id){ //encontrando a carta selecionada
    for(card of cardsObject){
        if(id == card.getId()){
            return card;
        }
    }
}

var modal = document.getElementById('simpleModal');
var modalBtn = document.getElementById('modalBtn');
var closeBtn = document.getElementsByClassName('closeBtn')[0];

// modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

function openModal(){
  modal.style.display = 'block';
}

function closeModal(){
  modal.style.display = 'none';
}

function outsideClick(e){
  if(e.target == modal){
    modal.style.display = 'none';
  }
}