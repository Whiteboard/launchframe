export default () => ({

    mounted() {
        let elementsToSizeAgainst = document.querySelectorAll(".elements-to-size-against");
        let elementsToResize = document.querySelectorAll(".elements-to-resize");
        let maxHeight = 0;
        elementsToSizeAgainst.forEach((element) => {
            let currentHeight = element.offsetHeight;
            if (currentHeight > maxHeight) maxHeight = currentHeight;
        });
        elementsToResize.forEach((element) => {
            element.style.height = `${maxHeight}px`;
        });
    }
})