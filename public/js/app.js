import './bootstrap';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import jQuery from 'jquery';
window.$ = jQuery;

gsap.registerPlugin(ScrollTrigger);
let speed = 100;
let preload = gsap.timeline();
let small = window.matchMedia("(max-width: 450px)")
let big = window.matchMedia("(min-width: 451px)")
var falling = gsap.timeline();

var total = 50;
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
    preload.to("#openinvitation", {y: -10 * speed, opacity: 0, duration: 1.2}, 0);
    preload.fromTo("#logo", 1.5, {y: -1000}, {y: 0, ease: "power2.easeInOut"}, "-=1.5");
    preload.fromTo("#info", 1.2, {y: 65 * speed}, {y: 100, ease: "power2.easeInOut"}, "-=1.5");
    preload.fromTo("#info2", 1.2, {x: 20, y: 65 * speed}, {x: 20, y: 100, ease: "power2.easeInOut"}, "-=1.5");
    preload.fromTo("#nada", 1.3, {x: 5 * speed}, {x: 0 * speed, ease: "power2.easeInOut"}, "-=1");
    preload.fromTo("#deny", 1.3, {x: -5 * speed}, {x: 0 * speed, ease: "power2.easeInOut"}, "-=1.3");
});

/*  SCENE 1 */
let scene1 = gsap.timeline();
ScrollTrigger.create({
    animation: scene1,
    trigger: ".scrollElement",
    start: "top top",
    end: "20% 10%",
    scrub: 1,
    markers: true,
});

// hills animation
scene1.to("#b1-1", { y: 5 * speed, x: 1 * speed, scale: 0.9, ease: "power2.easeInOut" }, 0)
scene1.to("#b1-2", { y: 4.6 * speed, x: -0.6 * speed, ease: "power2.easeInOut" }, 0)
scene1.to("#b1-3", { y: 3.7 * speed, x: 1.2 * speed }, 0)
scene1.to("#b1-4", { y: 4 * speed, x: -1 * speed }, 0)
scene1.to("#b1-5", { y: 4 * speed, x: -0.2 * speed, duration: 0.5 }, 0)
scene1.fromTo("#bg-1", {scale:1, opacity: 1}, {scale:2, opacity: 0}, 0)

//animate text
scene1.to("#logo", { y: 50 * speed, scale: 0.1, ease: "power1.in" }, -0.03)
scene1.to("#info", { y: 10 * speed }, 0)
scene1.to("#info2", { y: 10 * speed, opacity: 0, duration: 0.5 }, 0)
scene1.to("#nada", { x: 5 * speed, ease: "power2.easeInOut", duration: 0.2 }, 0)
scene1.to("#deny", { x: -5 * speed, ease: "power2.easeInOut", duration: 0.2 }, 0)
scene1.call(fall())

// Transisi Bg
let transisi = gsap.timeline();
ScrollTrigger.create({
    animation: transisi,
    trigger: ".scrollElement",
    start: "3% top",
    end: "15% 100%",
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
    end: "15% 100%",
    scrub: 1,
});
sakura.fromTo("#sakura", {opacity: 1}, { opacity: 0}, 0)

// Ayat
// gsap.set("#ayat1", { opacity: 0 })
let ayat = gsap.timeline();
ScrollTrigger.create({
    animation: ayat,
    trigger: ".scrollElement",
    start: "8% top",
    end: "17% 75%",
    scrub: 1,
    // pin: true,
    // markers: true,
});
ayat.from("#ayat1", {opacity: 0, scale: 2, ease: "power1.in"}, 0)
ayat.from("#ayat2", {opacity: 0, scale: 0, ease: "power1.in"}, 0)
ayat.from("#ayat3", {opacity: 0, scale: 0, ease: "power1.in"}, 0)
ayat.from("#b1-6", {x: -400, y: 500, ease: "power2.easeInOut", duration: 0.8}, 0)
ayat.from("#b1-7", {x: 400, y: 500, ease: "power2.easeInOut", duration: 0.7}, 0)
ayat.from("#b1-8", {x: -200, y: 500, ease: "power2.easeInOut", duration: 0.9}, 0)
ayat.from("#b1-9", {x: 200, y: 500, ease: "power2.easeInOut", duration: 0.9}, 0)
ayat.from("#b1-10", {y: 500, ease: "power2.easeInOut", duration: 1.15}, 0)
ayat.from("#b1-11", {y: 500, ease: "power2.easeInOut", duration: 1.15}, 0)
ayat.from("#b1-12", {y: 500, ease: "power2.easeInOut", duration: 1}, 0)

let ayatback = gsap.timeline();
ScrollTrigger.create({
    animation: ayatback,
    trigger: ".scrollElement",
    start: "16% 15%",
    end: "19% 25%",
    scrub: 1,
    // markers: true,
});
ayatback.to("#ayat3", {opacity:0, scale: 0, ease: "power1.out"}, 0)
ayatback.to("#ayat2", {opacity:0, scale: 0, ease: "power1.out"}, 0)
ayatback.to("#ayat1", {opacity:0, scale: 2, ease: "power1.out"}, 0)
ayatback.to("#b1-6", {x: -400, y: 500, ease: "power2.easeInOut", duration: 0.8}, 0)
ayatback.to("#b1-7", {x: 400, y: 500, ease: "power2.easeInOut", duration: 0.7}, 0)
ayatback.to("#b1-8", {x: -200, y: 500, ease: "power2.easeInOut", duration: 0.9}, 0)
ayatback.to("#b1-9", {x: 200, y: 500, ease: "power2.easeInOut", duration: 0.9}, 0)
ayatback.to("#b1-10", {y: 500, ease: "power2.easeInOut", duration: 1.15}, 0)
ayatback.to("#b1-11", {y: 500, ease: "power2.easeInOut", duration: 1.15}, 0)
ayatback.to("#b1-12", {y: 500, ease: "power2.easeInOut", duration: 1}, 0)

// Daun Kembali
let daun2 = gsap.timeline();
ScrollTrigger.create({
    animation: daun2,
    trigger: ".scrollElement",
    start: "19% 25%",
    end: "22% 25%",
    scrub: 1,
    // markers: true,
});
daun2.to("#daunkiri", {x: -400, ease: "power1.out"}, 0)
daun2.to("#daunkanan", {x: 400, ease: "power1.out"}, 0)

// Transisi BG 2
let transisi2 = gsap.timeline();
ScrollTrigger.create({
    animation: transisi2,
    trigger: ".scrollElement",
    start: "16% 27%",
    end: "19% 25%",
    scrub: 1,
    // markers: true,
});
transisi2.from("#bg-3", {opacity: 0, ease: "power1.in"})

/*   SCENE 2  */
let scene2 = gsap.timeline();
ScrollTrigger.create({
    animation: scene2,
    trigger: ".scrollElement",
    start: "15% top",
    end: "40% 100%",
    scrub: 4,
});

scene2.fromTo("#h2-1", { y: 500, opacity: 0 }, { y: 0, opacity: 1 }, 0)
scene2.fromTo("#h2-2", { y: 500 }, { y: 0 }, 0.1)
scene2.fromTo("#h2-3", { y: 700 }, { y: 0 }, 0.1)
scene2.fromTo("#h2-4", { y: 700 }, { y: 0 }, 0.2)
scene2.fromTo("#h2-5", { y: 800 }, { y: 0 }, 0.3)
scene2.fromTo("#h2-6", { y: 900 }, { y: 0 }, 0.3)


/* Bats */
gsap.fromTo("#bats", { opacity: 1, y: 400, scale: 0 }, {
    y: 100,
    scale: 0.8,
    transformOrigin: "50% 50%",
    ease: "power3.out",
    scrollTrigger: {
        trigger: ".scrollElement",
        start: "40% top",
        end: "70% 100%",
        scrub: 3,
        onEnter: function() {
            gsap.utils.toArray("#bats path").forEach((item, i) => {
                gsap.to(item, { scaleX: 0.5, yoyo: true, repeat: 11, duration: 0.15, delay: 0.7 + (i / 10), transformOrigin: "50% 50%" })
            });
            gsap.set("#bats", { opacity: 1 })
        },
        onLeave: function() { gsap.to("#bats", { opacity: 0, delay: 2 }) },
    }
})


/* Sun increase */
let sun2 = gsap.timeline();
ScrollTrigger.create({
    animation: sun2,
    trigger: ".scrollElement",
    start: "2200 top",
    end: "5000 100%",
    scrub: 1,
});

sun2.to("#sun", { attr: { offset: "0.6" } }, 0)
sun2.to("#bg_grad stop:nth-child(2)", { attr: { offset: "0.7" } }, 0)
sun2.to("#sun", { attr: { "stop-color": "#ffff00" } }, 0)
sun2.to("#lg4 stop:nth-child(1)", { attr: { "stop-color": "#623951" } }, 0)
sun2.to("#lg4 stop:nth-child(2)", { attr: { "stop-color": "#261F36" } }, 0)
sun2.to("#bg_grad stop:nth-child(6)", { attr: { "stop-color": "#45224A" } }, 0)



/* Transition (from Scene2 to Scene3) */
gsap.set("#scene3", { y: 580, visibility: "visible" })
let sceneTransition = gsap.timeline();
ScrollTrigger.create({
    animation: sceneTransition,
    trigger: ".scrollElement",
    start: "70% top",
    end: "bottom 100%",
    scrub: 3,
});

sceneTransition.to("#h2-1", { y: -1000, scale: 1.5, transformOrigin: "50% 50%" }, 0.01)
// sceneTransition.to("#h2-2", { y: -1600, scale: 2.2, transformOrigin: "50% 50%" }, 0)
// sceneTransition.to("#h2-3", { y: -1600, scale: 2.2, transformOrigin: "50% 50%" }, 0)
// sceneTransition.to("#h2-4", { y: -1600, scale: 2.2, transformOrigin: "50% 50%" }, 0)
// sceneTransition.to("#h2-5", { y: -1600, scale: 2.2, transformOrigin: "50% 50%" }, 0)
// sceneTransition.to("#h2-6", { y: -1600, scale: 2.2, transformOrigin: "50% 50%" }, 0)
sceneTransition.to("#bg_grad", { attr: { cy: "-80" } }, 0.00)
sceneTransition.to("#bg2", { y: 0 }, 0)

/* Scene 3 */
let scene3 = gsap.timeline();
ScrollTrigger.create({
    animation: scene3,
    trigger: ".scrollElement",
    start: "80% 50%",
    end: "bottom 100%",
    scrub: 3,
});

//Hills motion
scene3.fromTo("#h3-1", { y: 800 }, { y: 30 }, 0)
scene3.fromTo("#h3-2", { y: 800 }, { y: 30 }, 0.03)
scene3.fromTo("#h3-3", { y: 600 }, { y: 30 }, 0.06)
scene3.fromTo("#h3-4", { y: 800 }, { y: 30 }, 0.09)
scene3.fromTo("#h3-5", { y: 1000 }, { y: 30 }, 0.12)

//stars
scene3.fromTo("#stars", { opacity: 0 }, { opacity: 0.5, y: 0 }, 0)

// Scroll Back text
scene3.fromTo("#arrow2", { opacity: 0 }, { opacity: 0.7, y: -710 }, 0.25)
scene3.fromTo("#text2", { opacity: 0 }, { opacity: 0.7, y: -710 }, 0.3)

//gradient value change
scene3.to("#bg2-grad", { attr: { cy: 600 } }, 0)
scene3.to("#bg2-grad", { attr: { r: 500 } }, 0)


/*   falling star   */
gsap.to("#fstar", {
    x: -700,
    y: -250,
    ease: "power4.out",
    scrollTrigger: {
        trigger: ".scrollElement",
        start: "4000 top",
        end: "6000 100%",
        scrub: 5,
        onEnter: function() { gsap.set("#fstar", { opacity: 1 }) },
        onLeave: function() { gsap.set("#fstar", { opacity: 0 }) },
    }
})


//reset scrollbar position after refresh
window.onbeforeunload = function() {
    window.scrollTo(0, 0);
}


let fullscreen;
let fsEnter = document.getElementById('fullscr');
fsEnter.addEventListener('click', function (e) {
e.preventDefault();
if (!fullscreen) {
    fullscreen = true;
    document.documentElement.requestFullscreen();
    fsEnter.innerHTML = "Exit Fullscreen";
}
else {
    fullscreen = false;
    document.exitFullscreen();
    fsEnter.innerHTML = "Go Fullscreen";
}
});
