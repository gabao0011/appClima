//importar o React e os hooks useEffect e useState
import React, {use, useEffect, useState} from "react";

 //importa componentes básicos do React Native
 import { Image, StyleSheet, Text, View } from "react-native";

 function App(): React.JSX.Element{
  //Estado que armazena o nome da cidade
  const[city, setCity] = useState<string>("Presidente Epitácio");
  
  //estado que armazena a umidade
  const[humidity, setHumidity] = useState<string>("15");

  //estado que armazena a condição do clima
  const[condition, setCondition] = useState<string>("Ensolarado");

  //estado que armazena a probabilidade de chuva
  const[rainProbability, serRainProbability] = useState<string>("30");

  //estado que armazena a sensação térmica
  const[feelsLike, setFeelsLike] = useState<string>("41");

  //estado que armazena a temperatura atual
  const[temperatura, setTemperatura] = useState<string>("37");

  //estado booleano para controlar se é dia ou noite
  const[night, setNight] = useState<boolean>(false);

  function isNight(){
    //obtém a hora atual (0 a 23)
    const hour = new Date().getHours();
    console.log(hour);

    //se após 18hrs ou antes das 6h, considera noite
    if(hour >= 18 || hour < 6){
      setNight(true)
    }
    else {
      setNight(false);
    }
  }

  //hook que vai ser executado a cada minuto
  useEffect(() => {
    //Executa a verificação assim que o app abre
    isNight();

    //Cria um intervalo que verifica a cada 1 minuto
    const intervalId = setInterval(() => {
      isNight();
    }, 60000);

    //função de limpeza: remove o intervalo ao desmontar o componente
    return() => {
      clearInterval(intervalId);
    };
  }, []);

  //Renderização do componente
  return(
    //Container principal com fundo dinâmico (dia ou noite)
    <View
    style={[
        styles.container,
        styles.containerBgDay
      ]}
      >
      
      {/* cabeçalho com o nome da cidade */}
      <View style={styles.header}>
        <Text style={styles.city}>{city}</Text>
      </View>

      {/* container com temperatura e ícone */}
      <View style={styles.detailsContainer}>
        <Text style={styles.temperatura}>{temperatura}ºC</Text>
        <Image
        source={require("./assets/images/icon3.png")}
        style={styles.weatherIcon}
        />
      </View>

      {/* Informações adicionais do clima */}
      <View>
        <Text style={styles.weatherCondition}>{condition}</Text>
        <Text style={styles.text}>Sensação Térmica: {feelsLike}ºC</Text>
        <Text style={styles.text}>Probrabilidade de chuva: {rainProbability}%</Text>
        <Text style={styles.text}>Umidade: {humidity}%</Text>
      </View>

      {/* Imagem decorativa no rodape */}
      <Image
      source={require("./assets/images/cidade.png")}
      style={styles.bottomImage}
      />
    </View>

  );
}

//Estilos do aplicativo
const styles = StyleSheet.create({
  //Container principal
  container: {
    flex: 1,
    padding: 20
  },

  //Cor do fundo durante o dia
  containerBgDay: {
    backgroundColor:'#09d3f3'
  },

  //Cor do fundo duratne a noite
  containerBgNight: {
    backgroundColor:'#333'
  },

  //Imagem fixa no rodapé da tela
  bottomImage:{
    width:'115%',
    position:'absolute',
    bottom: 0,
    resizeMode: 'cover',
    height: '57%'
  },

  //Cabeçalho
  header: {
    flexDirection: 'row',
    justifyContent: 'center',
    marginBottom: 20
  },

  //Texto do nome da cidade
  city: {
    fontWeight:'bold',
    color: '#fff',
    fontSize: 25
  },

  //Ícone do clima
  weatherIcon: {
    width: 100,
    height: 100,
    alignSelf: 'flex-end',
    marginBottom: 20,
    flexDirection: 'row'
  },

  //Container da temperatura e ícone
  detailsContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between'
  },

  //Texto de condição climática
  weatherCondition: {
    fontSize: 18,
    fontWeight: 'bold',
    alignSelf: 'flex-end',
    marginBottom: 20,
    color: '#fff'
  },

  //Texto da temperatura
  temperatura: {
    fontSize: 55,
    marginBottom: 20,
    color: '#fff'
  },

  //Texto padrão das informações
  text: {
    fontSize: 17,
    color: '#fff',
    marginBottom: 10,
    fontStyle: 'italic'
  }

});

//exporta o componente para uso no app
export default App;