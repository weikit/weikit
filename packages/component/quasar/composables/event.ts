import { onUnmounted } from "@vue/runtime-core";
import { Emitter, EventType, Handler } from "mitt";
let emitter: Emitter;

export function setComponentEmitter(emitterInstance: Emitter) {
  emitter = emitterInstance;
}

export function useComponentEvent(
  eventName: EventType,
  listener: Handler,
  autoOff?: boolean
) {
  emitter.on(eventName, listener);

  if (autoOff) {
    onUnmounted(() => emitter.off(eventName, listener));
  }
}

export function emitComponentEvent(eventName: EventType, event: any) {
  emitter.emit(eventName, event);
}
