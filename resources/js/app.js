import './bootstrap';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import jQuery from 'jquery';
import Swiper from 'swiper/bundle';
import moment from 'moment';
// import {FlipDown} from "flipdown";
import 'swiper/css/bundle';
import select2 from 'select2';
import swal from 'sweetalert2'

window.swal = swal;
select2();
window.$ = jQuery;

// document.getElementsByClassName('.select2').select2();
// var select2 = new Select2(".select2");
gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
// var toAyat = document.getElementById("toAyat");
// toAyat.addEventListener('click', (e) => {
//     e.preventDefault();

//     gsap.to(window, {
//         // scrollTo: {y: 3485},
//         scrollTo: {y: 1000},
//         ease: "power4",
//         duration: 1
//     });
// });
// toCpw.addEventListener('click', (e) => {
//     e.preventDefault();

//     gsap.to(window, {
//         scrollTo: {y: 2080},
//         ease: "power4",
//         duration: 1
//     });
// });

var swiper = new Swiper(".pengantin", {
    autoplay: {
        delay: 4000
    },
    grabCursor: true,
    effect: "creative",
    creativeEffect: {
        prev: {
            shadow: true,
            translate: [0, 0, -400],
        },
        next: {
            translate: ["100%", 0, 0],
        },
    },
});

var swiper = new Swiper(".mySwiper", {
    lazy: true,
    autoplay: {
        delay: 4000
    },
    loop: true,
    spaceBetween: 10,
    slidesPerView: 3,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    lazy: true,
    autoplay: {
        delay: 4000
    },
    loop: true,
    spaceBetween: 10,
    thumbs: {
        swiper: swiper,
    },
});

var eventTime = moment("2024-01-20T08:00:00");
// based on time set in user's computer time / OS
var currentTime = moment();
// get duration between two times
var duration = moment.duration(eventTime.diff(currentTime));
console.log(currentTime);

gsap.registerPlugin(ScrollTrigger);
let speed = 100;
let preload = gsap.timeline();
var falling = gsap.timeline();

var total = 0;
var container = document.getElementById("container"),	w = window.innerWidth , h = window.innerHeight;

function fall(){
    for (let i=0; i<total; i++){
        var Div = document.createElement('div');
        gsap.set(Div,{attr:{class:'dot', id:'sakura'},x:R(-150,w),y:R(-200,-150),z:R(-200,200)});
        container.appendChild(Div);
        animm(Div);
    }
}

function animm(elm){
    falling.to(elm,R(6,15),{y:h+100,ease:"Linear.easeNone",repeat:-1,delay:-20});
    falling.to(elm,R(4,8),{x:'+=100',rotationZ:R(0,180),repeat:-1,yoyo:true,ease:"Sine.easeInOut"});
    falling.to(elm,R(2,8),{rotationX:R(0,360),rotationY:R(0,360),repeat:-1,yoyo:true,ease:"Sine.easeInOut",delay:-5});
};

function R(min,max) {return min+Math.random()*(max-min)};

$("#close").on("click",function(){
    preload.to("#openinvitation", {y: 40 * speed, opacity: 0, duration: 1.2}, 0);
    preload.fromTo("#logo", 1.5, {y: -1000}, {y: 0, ease: "power2.easeInOut"}, "-=1.5");
    // preload.fromTo("#info", 1.2, {y: 65 * speed}, {y: 100, ease: "power2.easeInOut"}, "-=1.5");
    preload.fromTo("#info2", 1.2, {x: 20, y: 65 * speed}, {x: 20, y: 100, ease: "power2.easeInOut"}, "-=1.5");
    preload.fromTo("#nama", 1.3, {y: 65 * speed}, {y: 0, ease: "power2.easeInOut"}, "-=1.3");
    // preload.fromTo("#nextayat", 1.3, {y: 65 * speed}, {y: 0, ease: "power2.easeInOut"}, "-=1.3");
    // preload.fromTo("#nada", 1.3, {x: 5 * speed}, {x: 0 * speed, ease: "power2.easeInOut"}, "-=1");
    // preload.fromTo("#deny", 1.3, {x: -5 * speed}, {x: 0 * speed, ease: "power2.easeInOut"}, "-=1.3");
});

/*  SCENE 1 */
let scene1 = gsap.timeline();
ScrollTrigger.create({
    animation: scene1,
    trigger: ".scrollElement",
    start: "top top",
    end: "20% 10%",
    scrub: 1,
    // markers: true,
});
scene1.call(fall())
// hills animation
scene1.to("#b1-1", { y: 5 * speed, x: 1 * speed, scale: 0.9, ease: "power2.easeInOut" }, 0)
scene1.to("#b1-2", { y: 4.6 * speed, x: -0.6 * speed, ease: "power2.easeInOut" }, 0)
scene1.to("#b1-3", { y: 3.7 * speed, x: 1.2 * speed }, 0)
scene1.to("#b1-4", { y: 4 * speed, x: -1 * speed }, 0)
scene1.to("#b1-5", { y: 4 * speed, x: -0.2 * speed, duration: 0.5 }, 0)
scene1.fromTo("#bg-1", {scale:1, opacity: 1}, {scale:2, opacity: 0}, 0)

//animate text
scene1.to("#logo", { y: 50 * speed, scale: 0.1, ease: "power1.in" }, -0.03)
// scene1.to("#info", { y: 10 * speed }, 0)
scene1.to("#info2", { y: 10 * speed, opacity: 0, duration: 0.5 }, 0)
scene1.to("#nama", { y: 8 * speed, opacity: 0, duration: 0.8 }, 0)
// scene1.to("#nextayat", { y: 8 * speed, opacity: 0, duration: 0.8 }, 0)

// Transisi Bg
let transisi = gsap.timeline();
ScrollTrigger.create({
    animation: transisi,
    trigger: ".scrollElement",
    start: "3% top",
    end: "10% 100%",
    scrub: 1,
    // markers: true,
});
transisi.from("#bg-2", { opacity: 0.1, scale: 2}, 0)

/*  Falling Leaf */
let sakura = gsap.timeline();
ScrollTrigger.create({
    animation: sakura,
    trigger: ".scrollElement",
    start: "5% top",
    end: "10% 100%",
    scrub: 1,
});
sakura.to("#sakura", { opacity: 0}, 0)

// Ayat
// gsap.set("#ayat1", { opacity: 0 })
let ayat = gsap.timeline();
ScrollTrigger.create({
    animation: ayat,
    trigger: ".scrollElement",
    start: "8% 80%",
    end: "12.5% 60%",
    scrub: 1,
    // pin: true,
    // markers: true,
});
ayat.from("#ayat1", {opacity: 0, scale: 2, ease: "power1.in", duration: 1}, 0)
ayat.from("#ayat2", {opacity: 0, scale: 0, ease: "power1.in", duration: 1}, 0)
ayat.from("#ayat3", {opacity: 0, scale: 0, ease: "power1.in", duration: 1}, 0)
// ayat.from("#nextcpw", {y: 8*speed, opacity: 0, ease: "power1.in", duration: 1}, 0)
ayat.from("#b1-6", {x: -400, y: -500, ease: "power2.easeInOut", duration: 0.8}, 0)
ayat.from("#b1-7", {x: 400, y: -500, ease: "power2.easeInOut", duration: 0.7}, 0)
ayat.from("#b1-8", {x: 200, y: 500, ease: "power2.easeInOut", duration: 1}, 0)
ayat.from("#b1-9", {x: -200, y: 500, ease: "power2.easeInOut", duration: 1}, 0)
ayat.from("#b1-10", {y: 500, ease: "power2.easeInOut", duration: 0.9}, 0)
ayat.from("#b1-11", {y: 500, ease: "power2.easeInOut", duration: 1.15}, 0)
ayat.from("#b1-12", {y: 400, ease: "power2.easeInOut", duration: 0.85}, 0)

let ayatback = gsap.timeline();
ScrollTrigger.create({
    animation: ayatback,
    trigger: ".scrollElement",
    start: "13.5% 10%",
    end: "18% 25%",
    scrub: 1,
    // markers: true,
});
ayatback.to("#ayat3", {opacity:0, scale: 0, ease: "power1.out", duration: 1}, 0)
ayatback.to("#ayat2", {opacity:0, scale: 0, ease: "power1.out", duration: 1}, 0)
ayatback.to("#ayat1", {opacity:0, scale: 2, ease: "power1.out", duration: 1}, 0)
ayatback.to("#b1-6", {x: -400, y: -500, ease: "power2.easeInOut", duration: 0.8}, 0)
ayatback.to("#b1-7", {x: 400, y: -500, ease: "power2.easeInOut", duration: 0.7}, 0)
ayatback.to("#b1-8", {x: 200, y: 500, ease: "power2.easeInOut", duration: 1}, 0)
ayatback.to("#b1-9", {x: -200, y: 500, ease: "power2.easeInOut", duration: 1}, 0)
ayatback.to("#b1-10", {y: 500, ease: "power2.easeInOut", duration: 0.85}, 0)
ayatback.to("#b1-11", {y: 500, ease: "power2.easeInOut", duration: 1.15}, 0)
ayatback.to("#b1-12", {y: 400, ease: "power2.easeInOut", duration: 0.85}, 0)

// Daun Kembali
let daun2 = gsap.timeline();
ScrollTrigger.create({
    animation: daun2,
    trigger: ".scrollElement",
    start: "16% 25%",
    end: "22% 25%",
    scrub: 1,
    // markers: true,
});
daun2.to("#sakura", { opacity: 1}, 0)
// daun2.to("#daunkiri", {x: -400, ease: "power1.out"}, 0)
// daun2.to("#daunkanan", {x: 400, ease: "power1.out"}, 0)

// Transisi BG 2
let transisi2 = gsap.timeline();
ScrollTrigger.create({
    animation: transisi2,
    trigger: ".scrollElement",
    start: "16% 27%",
    end: "17% 55%",
    scrub: 1,
    // markers: true,
});
transisi2.from("#bg-3", {opacity: 0, ease: "power1.in"}, 0)

// Pengantincpw
let pengantincpw = gsap.timeline();
ScrollTrigger.create({
    animation: pengantincpw,
    trigger: ".scrollElement",
    start: "18% 35%",
    end: "26% 25%",
    scrub: 1,
    // markers: true,
});
pengantincpw.to("#cpw-swiper", {zIndex: 2, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpw.from("#cpw-swiper", {opacity: 0, scale: 0.1, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpw.from("#cpw-name", {opacity: 0, width: 50, ease: "power2.easeInOut", duration: 1})
pengantincpw.from("#cpw-name", { height: 0, ease: "power2.easeInOut", duration: 1.2})
pengantincpw.to("#cpw-name2", {opacity: 1, ease: "power2.easeInOut", duration: 0.7})
pengantincpw.from("#swipe1", {opacity: 0, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpw.to("#b1-13", {opacity: 1, zIndex: 2, rotate: 0, x: -20, y: 35, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpw.to("#b1-14", {opacity: 1, zIndex: 2, rotate: 0, x: 20, y: 20, ease: "power2.easeInOut", duration: 0.7}, 0)
pengantincpw.to("#b1-15", {opacity: 1, zIndex: 2, rotate: 0, x: 27, y: "-30vh", ease: "power2.easeInOut", duration: 1.15}, 0)
pengantincpw.to("#b1-16", {opacity: 1, zIndex: 2, rotate: 0, x: 15, y: "-31vh", ease: "power2.easeInOut", duration: 1}, 0)
// pengantincpw.to("#b1-20", {opacity: 1, rotate: 0, x: -13, y: 15, ease: "power2.easeInOut", duration: 1}, 0)
// pengantincpw.from("#nada", { x: 4.5 * speed, ease: "power2.easeInOut", duration: 1 },0)
// pengantincpw.to("#b1-15", {opacity: 1, rotate: 0, x: -10, y: 10, ease: "power2.easeInOut", duration: 1.2}, 0)
// pengantincpw.to("#b1-16", {opacity: 1, rotate: 0, x: 10, y: 20, ease: "power2.easeInOut", duration: 1.2}, 0)
// pengantincpw.from("#swipe2", {opacity: 0, ease: "power2.easeInOut", duration: 1},0)
// pengantincpw.from("#deny", { x: -4.5 * speed, ease: "power2.easeInOut", duration: 1 },0)
// pengantincpw.to("#b1-17", {opacity: 1, rotate: 0, x: -15, y: -10, ease: "power2.easeInOut", duration: 1.15}, 0)

// Back Pengantincpw
let backpengantincpw = gsap.timeline();
ScrollTrigger.create({
    animation: backpengantincpw,
    trigger: ".scrollElement",
    start: "28% 15%",
    end: "33% 30%",
    scrub: 1,
    // markers: true,
});
backpengantincpw.to("#cpw-name2", {opacity: 0, ease: "power2.easeInOut", duration: 0.7})
backpengantincpw.to("#cpw-name", {height: 0, ease: "power2.easeInOut", duration: 1.2})
backpengantincpw.to("#cpw-name", {opacity: 0, width: 50, ease: "power2.easeInOut", duration: 1})
backpengantincpw.to("#cpw-swiper", {opacity: 0, scale: 0.1, ease: "power2.easeInOut", duration: 1})
backpengantincpw.to("#cpw-swiper", {zIndex: 0, ease: "power2.easeInOut", duration: 1})
backpengantincpw.to("#swipe1", {opacity: 0, ease: "power2.easeInOut", duration: 0.8})
backpengantincpw.to("#b1-13",{opacity: 0, zIndex: -1, rotate: -5, ease: "power2.easeInOut", duration: 1},0)
backpengantincpw.to("#b1-14",{opacity: 0, zIndex: -1, rotate: 15, ease: "power2.easeInOut", duration: 0.7},0)
backpengantincpw.to("#b1-15",{opacity: 0, zIndex: -1, rotate: -5, ease: "power2.easeInOut", duration: 1.15},0)
backpengantincpw.to("#b1-16",{opacity: 0, zIndex: -1, rotate: -5, ease: "power2.easeInOut", duration: 1},0)
// backpengantincpw.to("#nada", { x: 4.5 * speed, ease: "power2.easeInOut", duration: 0.8 },0)
// backpengantincpw.to("#b1-15",{opacity: 0, rotate: -5, ease: "power2.easeInOut", duration: 1.2},0)
// backpengantincpw.to("#b1-16",{opacity: 0, rotate: 15, ease: "power2.easeInOut", duration: 1.2},0)
// backpengantincpw.to("#swipe2", {opacity: 0, ease: "power2.easeInOut", duration: 0.8},0)
// backpengantincpw.to("#deny", { x: -4.5 * speed, ease: "power2.easeInOut", duration: 0.8 },0)
// backpengantincpw.to("#b1-17",{opacity: 0, rotate: 5, ease: "power2.easeInOut", duration: 1.15},0)
// backpengantincpw.to("#b1-20",{opacity: 0, rotate: 5, ease: "power2.easeInOut", duration: 1},0)

// Pengantincpw
let pengantincpp = gsap.timeline();
ScrollTrigger.create({
    animation: pengantincpp,
    trigger: ".scrollElement",
    start: "33% 25%",
    end: "41% 25%",
    scrub: 1,
    // markers: true,
});
pengantincpp.to("#cpp-swiper", {zIndex: 2, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpp.from("#cpp-swiper", {opacity: 0, scale: 0.1, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpp.from("#cpp-name", {opacity: 0, width: 50, ease: "power2.easeInOut", duration: 1})
pengantincpp.from("#cpp-name", {height: 0, ease: "power2.easeInOut", duration: 1.2})
pengantincpp.to("#cpp-name2", {opacity: 1, ease: "power2.easeInOut", duration: 0.7})
pengantincpp.from("#swipe1", {opacity: 0, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpp.to("#b1-17", {opacity: 1, zIndex: 2, rotate: 0, x: -20, y: 35, ease: "power2.easeInOut", duration: 1}, 0)
pengantincpp.to("#b1-18", {opacity: 1, zIndex: 2, rotate: 0, x: 20, y: 20, ease: "power2.easeInOut", duration: 0.7}, 0)
pengantincpp.to("#b1-19", {opacity: 1, zIndex: 2, rotate: 0, x: 27, y: "-30vh", ease: "power2.easeInOut", duration: 1.15}, 0)
pengantincpp.to("#b1-20", {opacity: 1, zIndex: 2, rotate: 0, x: 15, y: "-31vh", ease: "power2.easeInOut", duration: 1}, 0)

// Back Pengantincpw
let backpengantincpp = gsap.timeline();
ScrollTrigger.create({
    animation: backpengantincpp,
    trigger: ".scrollElement",
    start: "43% 15%",
    end: "48% 30%",
    scrub: 1,
    // markers: true,
});
backpengantincpp.to("#cpp-name2", {opacity: 0, ease: "power2.easeInOut", duration: 0.7})
backpengantincpp.to("#cpp-name", {height: 0, ease: "power2.easeInOut", duration: 1.2})
backpengantincpp.to("#cpp-name", {opacity: 0, width: 50, ease: "power2.easeInOut", duration: 1})
backpengantincpp.to("#cpp-swiper", {opacity: 0, scale: 0.1, ease: "power2.easeInOut", duration: 1})
backpengantincpp.to("#cpp-swiper", {zIndex: 0, ease: "power2.easeInOut", duration: 1})
backpengantincpp.to("#swipe1", {opacity: 0, ease: "power2.easeInOut", duration: 0.8})
backpengantincpp.to("#b1-17",{opacity: 0, zIndex: -1, rotate: -5, ease: "power2.easeInOut", duration: 1},0)
backpengantincpp.to("#b1-18",{opacity: 0, zIndex: -1, rotate: 15, ease: "power2.easeInOut", duration: 0.7},0)
backpengantincpp.to("#b1-19",{opacity: 0, zIndex: -1, rotate: -5, ease: "power2.easeInOut", duration: 1.15},0)
backpengantincpp.to("#b1-20",{opacity: 0, zIndex: -1, rotate: -5, ease: "power2.easeInOut", duration: 1},0)

backpengantincpp.to("#bg-3",{opacity: 0, ease: "power2.easeInOut", duration: 1},0)
backpengantincpp.to("#bg-4",{scale: 1, opacity: 1, ease: "power2.easeInOut", duration: 1},0)

// Info Akad
let akad = gsap.timeline();
ScrollTrigger.create({
    animation: akad,
    trigger: ".scrollElement",
    start: "47% 30%",
    end: "51% 25%",
    scrub: 1,
    // markers: true,
});
akad.from("#b1-21", {x: -50, y: -50,opacity: 0, ease: "power2.easeInOut", duration: 1}, 0)
akad.from("#b1-22", {x: -50, y: -30,opacity: 0, ease: "power2.easeInOut", duration: 0.8}, 0)
akad.from("#b1-23", {x: -50, y: 0,opacity: 0, ease: "power2.easeInOut", duration: 0.9}, 0)
akad.from("#b1-24", {x: -50, y: 40,opacity: 0, ease: "power2.easeInOut", duration: 0.7}, 0)
akad.from("#b1-25", {x: -50, y: -40,opacity: 0, ease: "power2.easeInOut", duration: 0.8}, 0)
akad.from("#b1-26", {x: 30, y: 40,opacity: 0, ease: "power2.easeInOut", duration: 1}, 0)
akad.from("#b1-27", {x: -75, y: -60,opacity: 0, ease: "power2.easeInOut", duration: 1})
akad.from("#b1-28", {x: -75, y: -50,opacity: 0, ease: "power2.easeInOut", duration: 0.75})

gsap.fromTo("#b1-27", {opacity: 0, y: -60, x: -75 }, {
    y: 0,
    x: 0,
    scale: 1,
    ease: "power3.out",
    scrollTrigger: {
        trigger: ".scrollElement",
        start: "47% 15%",
        end: "52% 60%",
        scrub: 1,
        // markers: true,
        onEnter: function() {
            gsap.to("#b1-27", { rotate: 1, yoyo: true, repeat: 80, duration: 1.2, delay: 0.7 })
            gsap.set("#b1-27", { opacity: 1 })
        }
    }
})

gsap.fromTo("#b1-28", {opacity: 0, y: -60, x: -75 }, {
    y: 0,
    x: 0,
    scale: 1,
    ease: "power3.out",
    scrollTrigger: {
        trigger: ".scrollElement",
        start: "47% 14%",
        end: "52% 60%",
        scrub: 1,
        // markers: true,
        onEnter: function() {
            gsap.to("#b1-28", { rotate: 1.5, yoyo: true, repeat: 80, duration: 1.2, delay: 0.8 })
            gsap.set("#b1-28", { opacity: 1 })
        }
    }
})

// Info Akad2
let event = gsap.timeline();
ScrollTrigger.create({
    animation: event,
    trigger: ".scrollElement",
    start: "52% 25%",
    end: "55% 30%",
    scrub: 1,
    // markers: true,
});
event.from("#event", {opacity: 0, ease: "power2.easeInOut", duration: 1},0)
event.from("#eventakad1", {x: 700, ease: "power2.easeInOut", duration: 1}, 0)
event.from("#eventakad2", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.2}, 0)
event.from("#eventakad3", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.35}, 0)
event.from("#eventakad4", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.50}, 0)
event.from("#eventakad5", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.65}, 0)
event.from("#eventakad6", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.80}, 0)
event.from("#eventresepsi1", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.95}, 0)
event.from("#eventresepsi2", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.1}, 0)
event.from("#eventresepsi3", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.25}, 0)
event.from("#eventresepsi4", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.40}, 0)
event.from("#eventresepsi5", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.55}, 0)
event.from("#eventresepsi6", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.70}, 0)

// Info Akad2
let eventback = gsap.timeline();
ScrollTrigger.create({
    animation: eventback,
    trigger: ".scrollElement",
    start: "57% 30%",
    end: "60% 30%",
    scrub: 1,
    // markers: true,
});
eventback.to("#event", {opacity: 0, ease: "power2.easeInOut", duration: 1})
eventback.to("#eventakad1", {x: 700, ease: "power2.easeInOut", duration: 1}, 0)
eventback.to("#eventakad2", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.2}, 0)
eventback.to("#eventakad3", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.35}, 0)
eventback.to("#eventakad4", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.50}, 0)
eventback.to("#eventakad5", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.65}, 0)
eventback.to("#eventakad6", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.80}, 0)
eventback.to("#eventresepsi1", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 0.95}, 0)
eventback.to("#eventresepsi2", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.1}, 0)
eventback.to("#eventresepsi3", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.25}, 0)
eventback.to("#eventresepsi4", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.40}, 0)
eventback.to("#eventresepsi5", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.55}, 0)
eventback.to("#eventresepsi6", {x: 700, ease: "power2.easeInOut", duration: 1, delay: 1.70}, 0)
eventback.to("#b1-21", {x: -50, y: -50,opacity: 0, ease: "power2.easeInOut", duration: 1}, 0.5)
eventback.to("#b1-22", {x: -50, y: -30,opacity: 0, ease: "power2.easeInOut", duration: 0.8}, 0.5)
eventback.to("#b1-23", {x: -50, y: 0,opacity: 0, ease: "power2.easeInOut", duration: 0.9}, 0.5)
eventback.to("#b1-24", {x: -50, y: 40,opacity: 0, ease: "power2.easeInOut", duration: 0.7}, 0.5)
eventback.to("#b1-25", {x: -50, y: -40,opacity: 0, ease: "power2.easeInOut", duration: 0.8}, 0.5)
eventback.to("#b1-26", {x: 30, y: 40,opacity: 0, ease: "power2.easeInOut", duration: 1}, 0.5)
eventback.to("#b1-27", {x: -75, y: -60,opacity: 0, ease: "power2.easeInOut", duration: 1}, 0.5)
eventback.to("#b1-28", {x: -75, y: -50,opacity: 0, ease: "power2.easeInOut", duration: 0.75}, 0.5)
eventback.to("#bg-4", { scale: 1, opacity: 1, ease: "power2.easeInOut", duration: 1},0)

// Sakura on again
let sakuraon = gsap.timeline();
ScrollTrigger.create({
    animation: sakuraon,
    trigger: ".scrollElement",
    start: "60% 30%",
    end: "62% 30%",
    scrub: 1,
    // markers: true,
});
sakuraon.to("#bg-6", { scale: 1, opacity: 1, ease: "power2.easeInOut"},0)
// sakuraon.to("#sakura", { opacity: 1}, 0)

let rsvp = gsap.timeline();
ScrollTrigger.create({
    animation: rsvp,
    trigger: ".scrollElement",
    start: "60% 25%",
    end: "64% 30%",
    scrub: 1,
    // markers: true,
});
rsvp.from("#rsvp", { scale:0, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

let rsvpout = gsap.timeline();
ScrollTrigger.create({
    animation: rsvpout,
    trigger: ".scrollElement",
    start: "68% 45%",
    end: "70% 30%",
    scrub: 1,
    // markers: true,
});
rsvpout.to("#rsvp", { y: -1000, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

// Gallery
let gallery = gsap.timeline();
ScrollTrigger.create({
    animation: gallery,
    trigger: ".scrollElement",
    start: "70% 50%",
    end: "73% 50%",
    scrub: 1,
    // markers: true,
});
gallery.from("#gallery", { scale:0, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

let galleryout = gsap.timeline();
ScrollTrigger.create({
    animation: galleryout,
    trigger: ".scrollElement",
    start: "75% 45%",
    end: "77% 30%",
    scrub: 1,
    // markers: true,
});
galleryout.to("#gallery", { y: -1000, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

let gift = gsap.timeline();
ScrollTrigger.create({
    animation: gift,
    trigger: ".scrollElement",
    start: "77% 50%",
    end: "80% 50%",
    scrub: 1,
    // markers: true,
});
gift.from("#gift", { scale:0, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

let giftout = gsap.timeline();
ScrollTrigger.create({
    animation: giftout,
    trigger: ".scrollElement",
    start: "82% 45%",
    end: "84% 30%",
    scrub: 1,
    // markers: true,
});
giftout.to("#gift", { opacity: 0, y: -1000, zIndex: -1, ease: "power2.easeInOut"},0)

let ucapan = gsap.timeline();
ScrollTrigger.create({
    animation: ucapan,
    trigger: ".scrollElement",
    start: "84% 50%",
    end: "87% 50%",
    scrub: 1,
    // markers: true,
});
ucapan.from("#ucapan", { scale:0, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

let ucapanout = gsap.timeline();
ScrollTrigger.create({
    animation: ucapanout,
    trigger: ".scrollElement",
    start: "89% 45%",
    end: "91% 30%",
    scrub: 1,
    // markers: true,
});
ucapanout.to("#ucapan", { opacity: 0, y: -1000, zIndex: -1, ease: "power2.easeInOut"},0)

let thankyou = gsap.timeline();
ScrollTrigger.create({
    animation: thankyou,
    trigger: ".scrollElement",
    start: "91% 50%",
    end: "93% 50%",
    scrub: 1,
    // markers: true,
});
thankyou.from("#thankyou", { scale: 0, opacity: 0, zIndex: -1, ease: "power2.easeInOut"},0)

//reset scrollbar position after refresh
window.onbeforeunload = function() {
    window.scrollTo(0, 0);
}


// let fullscreen;
// let fsEnter = document.getElementById('fullscr');
// fsEnter.addEventListener('click', function (e) {
// e.preventDefault();
// if (!fullscreen) {
//     fullscreen = true;
//     document.documentElement.requestFullscreen();
//     fsEnter.innerHTML = "Exit Fullscreen";
// }
// else {
//     fullscreen = false;
//     document.exitFullscreen();
//     fsEnter.innerHTML = "Go Fullscreen";
// }
// });
