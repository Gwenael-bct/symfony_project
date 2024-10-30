import { Controller } from "stimulus";

export default class extends Controller {
    static targets = ["count"];

    initialize() {
        this.countValue = 0;
    }

    increment() {
        this.countValue++;
        this.countTarget.textContent = this.countValue;
    }
}
