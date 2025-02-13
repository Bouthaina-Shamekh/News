// تسجيل ScrollTrigger
gsap.registerPlugin(ScrollTrigger);

// Hero + Header
gsap.from("nav", {
    scrollTrigger: {
        trigger: "nav",
        start: "top 85%",
    },
    y: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".logo__hero, .text__hero", {
    scrollTrigger: {
        trigger: ".logo__hero",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".right__hero, .img__hero", {
    scrollTrigger: {
        trigger: ".right__hero",
        start: "top 85%",
    },
    x: 80,
    opacity: 0,
    duration: 2,
});

// Footer
gsap.from(".links__footer", {
    scrollTrigger: {
        trigger: ".links__footer",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
    stagger: 0.1,
});

gsap.from(".top__footer", {
    scrollTrigger: {
        trigger: ".top__footer",
        start: "top 85%",
    },
    y: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".text__footer", {
    scrollTrigger: {
        trigger: ".text__footer",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".w", {
    scrollTrigger: {
        trigger: "footer",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
});

// About
gsap.from(".img__about, .partial__about", {
    scrollTrigger: {
        trigger: ".img__about",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".text__about", {
    scrollTrigger: {
        trigger: ".text__about",
        start: "top 85%",
    },
    x: 80,
    opacity: 0,
    duration: 2,
});

// Services
gsap.from(".text__service", {
    scrollTrigger: {
        trigger: ".text__service",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".service__box", {
    scrollTrigger: {
        trigger: ".service__box",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
});

gsap.from(".img__service", {
    scrollTrigger: {
        trigger: ".img__service",
        start: "top 85%",
    },
    x: 80,
    opacity: 0,
    duration: 2,
});

// Files
gsap.from(".top__files", {
    scrollTrigger: {
        trigger: ".top__files",
        start: "top 85%",
    },
    y: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".partial__files, .left__files", {
    scrollTrigger: {
        trigger: ".partial__files",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".card__file", {
    scrollTrigger: {
        trigger: ".card__file",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
});

// Partners
gsap.from(".left_partners", {
    scrollTrigger: {
        trigger: ".left_partners",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".right_partners", {
    scrollTrigger: {
        trigger: ".right_partners",
        start: "top 85%",
    },
    x: 80,
    opacity: 0,
    duration: 2,
});

gsap.from(".center__partners", {
    scrollTrigger: {
        trigger: ".center__partners",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
});

gsap.from(".img__partners", {
    scrollTrigger: {
        trigger: ".img__partners",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
});

// Work
gsap.from(".text__work", {
    scrollTrigger: {
        trigger: ".text__work",
        start: "top 85%",
    },
    y: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".left__work", {
    scrollTrigger: {
        trigger: ".left__work",
        start: "top 85%",
    },
    x: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".right__work", {
    scrollTrigger: {
        trigger: ".right__work",
        start: "top 85%",
    },
    x: 80,
    opacity: 0,
    duration: 2,
});

gsap.from(".top__work", {
    scrollTrigger: {
        trigger: ".top__work",
        start: "top 85%",
    },
    y: -80,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
});

// Clients
gsap.from(".text__client", {
    scrollTrigger: {
        trigger: ".text__client",
        start: "top 85%",
    },
    y: -80,
    opacity: 0,
    duration: 2,
});

gsap.from(".review__arrow", {
    scrollTrigger: {
        trigger: ".review__arrow",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
});

gsap.from(".img__client2", {
    scrollTrigger: {
        trigger: ".img__client",
        start: "top 85%",
    },
    y: 80,
    opacity: 0,
    duration: 2,
    stagger: 0.2,
});
