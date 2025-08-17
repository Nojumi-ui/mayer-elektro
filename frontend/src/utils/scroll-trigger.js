import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function revealOnScroll() {
  gsap.utils.toArray(".reveal").forEach((el) => {
    gsap.from(el, {
      y: 50,
      opacity: 0,
      duration: 1,
      scrollTrigger: {
        trigger: el,
        start: "top 85%"
      }
    });
  });
}
